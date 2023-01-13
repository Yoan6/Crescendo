/*======================================================
*                       CONFIG
========================================================*/
-- \i ./create_postgreSQL.sql; (mon chemin windows pour créer lancer le fichier)

/*======================================================
*                       DROP
========================================================*/
DROP TABLE IF EXISTS IMAGE_ARTICLE, LIKE_DISLIKE, CONCERNE,FAVORISE, ENCHERIT,GAGNE, ARTICLE, ENCHERE, UTILISATEUR CASCADE;


/*======================================================
*                       CREATE TABLE
========================================================*/
------------------------------TABLES ENTITES------------------------------
CREATE TABLE IF NOT EXISTS UTILISATEUR  (
    num_utilisateur SERIAL PRIMARY KEY, 
    email VARCHAR UNIQUE,                                      
    pseudo VARCHAR,
    mot_de_passe chkpass, --chkpass
    nom VARCHAR,
    prenom VARCHAR,
    date_naissance DATE,
    ville VARCHAR,
    rue VARCHAR NULL,
    code_postal VARCHAR, 
    img_profil VARCHAR
);

CREATE TABLE IF NOT EXISTS ARTICLE (
    num_article SERIAL PRIMARY KEY, 
    num_vendeur INTEGER REFERENCES Utilisateur(num_utilisateur), 
    titre VARCHAR,
    prix_min INTEGER,
    description_article VARCHAR,
    artiste VARCHAR,
    etat VARCHAR,
    categorie VARCHAR,
    taille VARCHAR,
    date_evenement DATE,
    lieu VARCHAR,
    style VARCHAR,
    UNIQUE(titre,description_article)
);

CREATE TABLE IF NOT EXISTS ENCHERE (
    num_enchere SERIAL PRIMARY KEY, 
    date_debut DATE,
    est_lot BOOLEAN
);

------------------------------TABLES ASSOCIATION------------------------------




---------------ENTRE UTILISATEUR ET ENCHERE
CREATE TABLE IF NOT EXISTS GAGNE (
    num_utilisateur INTEGER references UTILISATEUR(num_utilisateur) ON DELETE CASCADE, 
    num_enchere INTEGER references ENCHERE(num_enchere) ON DELETE CASCADE,
    PRIMARY KEY (num_utilisateur,num_enchere)
);

CREATE TABLE IF NOT EXISTS ENCHERIT (
    num_utilisateur INTEGER references UTILISATEUR(num_utilisateur) ON DELETE CASCADE, 
    num_enchere INTEGER references ENCHERE(num_enchere) ON DELETE CASCADE,
    prix_offre INTEGER,             
    date_encherissement DATE,     
    id_paiement INTEGER,          
    PRIMARY KEY (num_utilisateur,num_enchere)
);

CREATE TABLE IF NOT EXISTS FAVORISE (
    num_utilisateur INTEGER references UTILISATEUR(num_utilisateur) ON DELETE CASCADE, 
    num_enchere INTEGER references ENCHERE(num_enchere) ON DELETE CASCADE,
    PRIMARY KEY (num_utilisateur,num_enchere)
);


CREATE TABLE IF NOT EXISTS LIKE_DISLIKE( 
    num_article INTEGER references ARTICLE(num_article) ON DELETE CASCADE,
    num_enchere INTEGER references ENCHERE(num_enchere) ON DELETE CASCADE,
    est_like BOOLEAN,
    PRIMARY KEY (num_article,num_enchere)
);



CREATE TABLE IF NOT EXISTS IMAGE_ARTICLE(
    num_article INTEGER references ARTICLE(num_article) ON DELETE CASCADE,
    nom_image VARCHAR,
    PRIMARY KEY (num_article,nom_image)
);


---------------ENTRE ARTICLE ET ENCHERE
CREATE TABLE IF NOT EXISTS CONCERNE (
    num_article INTEGER references ARTICLE(num_article) ON DELETE CASCADE,
    num_enchere INTEGER references ENCHERE(num_enchere) ON DELETE CASCADE,
    PRIMARY KEY (num_article,num_enchere)
);

/*======================================================
*                         TRIGGER
========================================================*/
CREATE OR REPLACE FUNCTION check_price_func() RETURNS TRIGGER AS $$
BEGIN
    IF (NEW.prix_offre <= (SELECT MAX(prix_offre) FROM ENCHERIT WHERE num_enchere = NEW.num_enchere)) THEN
        RAISE EXCEPTION 'Prix proposé inférieur ou égal à l''enchère actuelle';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER check_price
BEFORE INSERT ON ENCHERIT
FOR EACH ROW
EXECUTE FUNCTION check_price_func();

-- Create the function
CREATE OR REPLACE FUNCTION delete_enchere_on_article_delete()
RETURNS TRIGGER AS $$
BEGIN
  DELETE FROM enchere e
  USING CONCERNE c
  WHERE c.num_article = OLD.num_article AND c.num_enchere = e.num_enchere;
  RETURN NULL;
END;
$$ LANGUAGE plpgsql;

-- Create the trigger
CREATE TRIGGER delete_enchere
AFTER DELETE ON article
FOR EACH ROW
EXECUTE FUNCTION delete_enchere_on_article_delete();
/*======================================================
*                      view
========================================================*/
CREATE VIEW upcoming_auctions AS
SELECT num_article, num_enchere
FROM CONCERNE
WHERE num_enchere IN (SELECT num_enchere FROM ENCHERE WHERE date_debut BETWEEN NOW() AND NOW() + INTERVAL '7 DAYS');


/*======================================================
*                      IMPORTAGE DES DONNEES
========================================================*/
-- Chemin à changer en fonction de celui qui lance le fichier
\copy utilisateur from '/var/www/html/crescendo/data/sql_base_donnees_actuelle/initialisation/utilisateurs.initialisation.txt' (DELIMITER '|', ENCODING 'UTF8',NULL '');
\copy ARTICLE from '/var/www/html/crescendo/data/sql_base_donnees_actuelle/initialisation/articles.initialisation.txt' (DELIMITER '|', ENCODING 'UTF8',NULL '');
\copy ENCHERE from '/var/www/html/crescendo/data/sql_base_donnees_actuelle/initialisation/encheres.initialisation.txt' (DELIMITER '|', ENCODING 'UTF8',NULL '');
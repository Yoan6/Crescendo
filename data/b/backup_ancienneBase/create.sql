/**************************************
**  Génération des tables Utiliser la commande (sur sqlite)   
**
** .read create.sql
**
**************************************/
.print ''
.print '===========================  CREATION DES TABLES  ==========================='


/*SQLITE n'autorise le drop d'une table qu'une par une*/
DROP TABLE IF EXISTS IMAGE_ARTICLE;
DROP TABLE IF EXISTS LIKE_DISLIKE;
DROP TABLE IF EXISTS CONCERNE;
DROP TABLE IF EXISTS FAVORISE;
DROP TABLE IF EXISTS ENCHERIT;
DROP TABLE IF EXISTS GAGNE;

DROP TABLE IF EXISTS ARTICLE;
DROP TABLE IF EXISTS ENCHERE;
DROP TABLE IF EXISTS UTILISATEUR;



CREATE TABLE IF NOT EXISTS UTILISATEUR  (
    num_utilisateur INTEGER PRIMARY KEY AUTOINCREMENT, -- CHANGEMENT
    email VARCHAR,                                      -- CHANGEMENT
    pseudo VARCHAR,
    mot_de_passe PASSWORD,
    nom VARCHAR,
    prenom VARCHAR,
    date_naissance DATE,
    ville VARCHAR,
    rue VARCHAR NULL,
    code_postal VARCHAR, 
    img_profil VARCHAR
);

CREATE TABLE IF NOT EXISTS ENCHERE (
    num_enchere INTEGER PRIMARY KEY AUTOINCREMENT, 
    date_debut DATE,
    est_lot BOOLEAN --Suppresion de prix et id_paiement mis dans ENCHERIT
); --Suppression de nombre de like, Une table intermédiaire ENTRE utilisateur et enchere sera créée plus tard

CREATE TABLE IF NOT EXISTS ARTICLE (
    num_article INTEGER PRIMARY KEY AUTOINCREMENT, 
    num_vendeur INTEGER REFERENCES Utilisateur(num_utilisateur) ON DELETE CASCADE, -- ajout 
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




/**************************************
**  Autres
**************************************/
.headers on
.separator ROW "\n"
.separator '|'
.nullvalue Null

.import ../../sql_base_donnees_actuelle/initialisation/encheres.initialisation.txt ENCHERE
.import ../../sql_base_donnees_actuelle/initialisation/utilisateurs.initialisation.txt UTILISATEUR
.import ../../sql_base_donnees_actuelle/initialisation/articles.initialisation.txt ARTICLE
.import ./initialisation/concernes.initialisation.txt CONCERNE
.import ./initialisation/images.initialisation.txt IMAGE_ARTICLE

.print '===========================  TESTS  ==========================='

SELECT * from ARTICLE;
.print

insert into UTILISATEUR values (4,'root@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
SELECT * from UTILISATEUR;
.print

SELECT * from ENCHERE;
.print


/*SELECT * from UTILISATEUR where rue is NULL;*/
--.quit;

.print '===========================  TRIGGER  ==========================='










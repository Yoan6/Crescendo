
/*SQLITE n'autorise le drop d'une table qu'une par une*/


CREATE TABLE IF NOT EXISTS UTILISATEUR  (
    email VARCHAR primary key,
    pseudo VARCHAR,
    mot_de_passe chkpass,
    nom VARCHAR,
    prenom VARCHAR,
    date_naissance DATE,
    ville VARCHAR,
    rue VARCHAR NULL,
    code_postal VARCHAR, 
    img_profil VARCHAR
);

CREATE TABLE IF NOT EXISTS ENCHERE (
    num_enchere SERIAL PRIMARY KEY, 
    prix_actuel INTEGER,
    id_paiement INTEGER,
    date_debut DATE,
    est_lot BOOLEAN,
    nb_Like INTEGER
);

CREATE TABLE IF NOT EXISTS ARTICLE (
    num_article SERIAL PRIMARY KEY, 
    titre VARCHAR,
    img_url VARCHAR,
    prix_min INTEGER,
    description_article VARCHAR,
    artiste VARCHAR,
    etat VARCHAR,
    categorie VARCHAR,
    taille VARCHAR,
    date_evenement DATE,
    lieu VARCHAR,
    style VARCHAR
);

CREATE TABLE IF NOT EXISTS GAGNE (
    email VARCHAR REFERENCES UTILISATEUR(email),
    num_enchere INTEGER REFERENCES ENCHERE(num_enchere),
    PRIMARY KEY (email,num_enchere)
);


CREATE TABLE IF NOT EXISTS ENCHERIT (
    email VARCHAR REFERENCES UTILISATEUR(email),
    num_enchere INTEGER REFERENCES ENCHERE(num_enchere),
    PRIMARY KEY (email,num_enchere)
);

CREATE TABLE IF NOT EXISTS FAVORISE (
    email VARCHAR REFERENCES UTILISATEUR(email),
    num_enchere INTEGER REFERENCES ENCHERE(num_enchere),
    PRIMARY KEY (email,num_enchere)
);

CREATE TABLE IF NOT EXISTS VEND (
    email VARCHAR REFERENCES UTILISATEUR(email),
    num_article INTEGER REFERENCES ARTICLE(num_article),
    PRIMARY KEY (email,num_article)
);

CREATE TABLE IF NOT EXISTS CONCERNE (
    num_article INTEGER REFERENCES ARTICLE(num_article),
    num_enchere INTEGER REFERENCES ENCHERE(num_enchere),
    PRIMARY KEY (num_article,num_enchere)
);



/**************************************
**  Autres
**************************************/
CREATE OR REPLACE FUNCTION encherir_delete_func()
RETURNS TRIGGER AS $$
BEGIN
    DELETE FROM CONCERNE
    WHERE num_enchere = OLD.num_enchere;
    RETURN OLD;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS encherir_delete ON ENCHERE;
CREATE TRIGGER encherir_delete 
    BEFORE DELETE 
    on ENCHERE
    FOR EACH ROW
    EXECUTE FUNCTION encherir_delete_func();
    
CREATE OR REPLACE FUNCTION encherir_delete_func_article()
RETURNS TRIGGER AS $$
BEGIN
    DELETE FROM ENCHERE WHERE (SELECT num_enchere FROM CONCERNE where num_article = OLD.num_article); 
    DELETE FROM CONCERNE
    WHERE num_article = OLD.num_article;
    RETURN OLD;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS encherir_delete ON ARTICLE;
CREATE TRIGGER encherir_delete 
    BEFORE DELETE 
    ON ARTICLE
    FOR EACH ROW
    EXECUTE FUNCTION encherir_delete_func_article();






CREATE OR REPLACE FUNCTION eviter_article_doublon_func()
RETURNS TRIGGER AS $$
BEGIN
	IF  (SELECT titre from ARTICLE WHERE (titre,description_article) 
		= (NEW.titre,NEW.description) IS NOT NULL) THEN 
	RAISE EXCEPTION 'Doublon';
    	END IF; 
END;
$$ LANGUAGE plpgsql;





DROP TRIGGER IF EXISTS eviter_article_doublon ON ARTICLE;
CREATE TRIGGER eviter_article_doublon
    BEFORE INSERT 
    ON ARTICLE
    FOR EACH ROW
    EXECUTE FUNCTION eviter_article_doublon_func();


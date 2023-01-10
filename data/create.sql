/**************************************
**  Génération des tables Utiliser la commande (sur sqlite)   
**
** .read create.sql
**
**************************************/
.print ''
.print '===========================  CREATION DES TABLES  ==========================='


/*SQLITE n'autorise le drop d'une table qu'une par une*/
DROP TABLE IF EXISTS CONCERNE;
DROP TABLE IF EXISTS VEND;
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
    num_enchere INTEGER PRIMARY KEY AUTOINCREMENT, --AUTOINCREMENT par SERIAL pour postGRESQL 
    prix_actuel INTEGER,
    id_paiement INTEGER,
    date_debut DATE,
    est_lot BOOLEAN,
    nb_Like INTEGER
);

CREATE TABLE IF NOT EXISTS ARTICLE (
    num_article INTEGER PRIMARY KEY AUTOINCREMENT, --AUTOINCREMENT par SERIAL pour postGRESQL 
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
    num_utilisateur references UTILISATEUR(num_utilisateur), --- CHangement num_utilisateur à la place d'email
    num_enchere references ENCHERE(num_enchere),
    PRIMARY KEY (num_utilisateur,num_enchere)
);

CREATE TABLE IF NOT EXISTS ENCHERIT (
    num_utilisateur references UTILISATEUR(num_utilisateur), --- CHangement num_utilisateur à la place d'email
    num_enchere references ENCHERE(num_enchere),
    PRIMARY KEY (num_utilisateur,num_enchere)
);

CREATE TABLE IF NOT EXISTS FAVORISE (
    num_utilisateur references UTILISATEUR(num_utilisateur), --- CHangement num_utilisateur à la place d'email
    num_enchere references ENCHERE(num_enchere),
    PRIMARY KEY (num_utilisateur,num_enchere)
);

CREATE TABLE IF NOT EXISTS VEND (
    num_utilisateur references UTILISATEUR(num_utilisateur), --- CHangement num_utilisateur à la place d'email
    num_article references ARTICLE(num_article),
    PRIMARY KEY (num_utilisateur,num_article)
);

CREATE TABLE IF NOT EXISTS CONCERNE (
    num_article references ARTICLE(num_article),
    num_enchere references ENCHERE(num_enchere),
    PRIMARY KEY (num_article,num_enchere)
);


/**************************************
**  Autres
**************************************/
.headers on
.separator ROW "\n"
.separator '|'
.nullvalue Null

.import ./initialisation/encheres.initialisation.txt ENCHERE
.import  ./initialisation/utilisateurs.initialisation.txt UTILISATEUR
.import ./initialisation/articles.initialisation.txt ARTICLE

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


DROP TRIGGER IF EXISTS encherir_delete;
CREATE TRIGGER encherir_delete 
    BEFORE DELETE 
    on ENCHERE
    FOR EACH ROW
    BEGIN --Sqlite n'a pas de fonction
        DELETE FROM CONCERNE
        WHERE num_enchere = OLD.num_enchere;
    END;


DROP TRIGGER IF EXISTS encherir_delete;
CREATE TRIGGER encherir_delete 
    BEFORE DELETE 
    on ARTICLE
    FOR EACH ROW
    BEGIN --Sqlite n'a pas de fonction
        DELETE FROM ENCHERE WHERE (SELECT num_enchere FROM CONCERNE where num_article = OLD.num_article); -- Une enchere dépend d'un article
        DELETE FROM CONCERNE
        WHERE num_article = OLD.num_article;
    END;

DROP TRIGGER IF EXISTS eviter_article_doublon;
CREATE TRIGGER eviter_article_doublon
    BEFORE INSERT 
    on ARTICLE
    FOR EACH ROW
    BEGIN --sqlite n'a pas de fonction
        SELECT CASE WHEN ( (SELECT titre from ARTICLE WHERE (titre,description_article) = (new.titre,new.description_article)) is NOT NULL)
        THEN RAISE(FAIL,'Doublon') END; --SYNTAXE spécifique à SQLITE
    END;








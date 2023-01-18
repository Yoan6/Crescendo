/**************************************
**  Génération des tables Utiliser la commande (sur sqlite)   
**
** .read create.sql
**
**************************************/
.print ''
.print '===========================  CREATION DES TABLES  ==========================='


/*SQLITE n'autorise le drop d'une table qu'une par une*/
DROP VIEW IF EXISTS ENCHERE_TOUT_VIEW;
DROP VIEW IF EXISTS ENCHERE_TOUT_EN_COURS_VIEW;
DROP VIEW IF EXISTS PRIX_ACTUEL_VIEW;
DROP VIEW IF EXISTS ENCHERISSEMENT_MAX_VIEW;

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
    PRIMARY KEY (num_utilisateur,num_enchere,prix_offre)
);

CREATE TABLE IF NOT EXISTS FAVORISE (
    num_utilisateur INTEGER references UTILISATEUR(num_utilisateur) ON DELETE CASCADE, 
    num_enchere INTEGER references ENCHERE(num_enchere) ON DELETE CASCADE,
    PRIMARY KEY (num_utilisateur,num_enchere)
);


CREATE TABLE IF NOT EXISTS LIKE_DISLIKE( 
    num_utilisateur INTEGER references UTILISATEUR(num_utilisateur) ON DELETE CASCADE,
    num_enchere INTEGER references ENCHERE(num_enchere) ON DELETE CASCADE,
    est_like BOOLEAN,
    PRIMARY KEY (num_utilisateur,num_enchere)
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

.import ../../sql_base_donnees_actuelle/initialisation/enchere.initialisation.txt ENCHERE
.import ../../sql_base_donnees_actuelle/initialisation/utilisateur.initialisation.txt UTILISATEUR
.import ../../sql_base_donnees_actuelle/initialisation/articles.initialisation.txt ARTICLE
.import ../../sql_base_donnees_actuelle/initialisation/concerne.initialisation.txt CONCERNE
.import ../../sql_base_donnees_actuelle/initialisation/image.initialisation.txt IMAGE_ARTICLE
.import ../../sql_base_donnees_actuelle/initialisation/encherit.initialisation.txt ENCHERIT

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




.print '===========================  AUTRES ==========================='
CREATE VIEW ENCHERISSEMENT_MAX_VIEW as select *, max(prix_offre) as prix_max
                                    FROM encherit
                                    group by num_enchere;

/* Il faut la version 3.32 de sqlite pour le IIF
CREATE VIEW ENCHERE_TOUT_VIEW as SELECT *, max(IIF(prix_offre is Null,0,prix_offre),prix_min) as prix_actuel
            from ARTICLE natural join CONCERNE natural join ENCHERE natural LEFT join ENCHERISSEMENT_MAX_VIEW  
            group by num_enchere;
*/

CREATE VIEW ENCHERE_TOUT_VIEW as SELECT *, sum(max((SELECT case WHEN prix_offre is Null THEN 0 ELSE prix_offre END),prix_min)) as prix_actuel
            from ARTICLE natural join CONCERNE natural join ENCHERE natural LEFT join ENCHERISSEMENT_MAX_VIEW  
            group by num_enchere;       

UPDATE ENCHERE set date_debut = DATE();

create VIEW ENCHERE_TOUT_EN_COURS_VIEW as select * from ENCHERE_TOUT_VIEW
    WHERE num_enchere IN (SELECT num_enchere FROM ENCHERE WHERE date_debut BETWEEN DATE() AND datetime(DATE(), '+7 DAYS'));

/*
DROP VIEW LIKE_DISLIKE_VIEW;
CREATE VIEW LIKE_DISLIKE_VIEW as SELECT * from LIKE_DISLIKE;


DROP VIEW FAVORISE_VIEW;
CREATE VIEW FAVORISE_VIEW as SELECT * from FAVORISE;

.print '===========================  TRIGGER  ==========================='

DROP TRIGGER IF EXISTS like_insert1;
CREATE TRIGGER like_insert1 INSTEAD OF INSERT on LIKE_DISLIKE_VIEW FOR EACH ROW
    WHEN (select est_Like from LIKE_DISLIKE where (num_enchere,num_utilisateur) = (new.num_enchere,new.num_utilisateur))  = new.est_like
    BEGIN --Sqlite n'a pas de fonction  (ni de IF avant 3.32)
        -- Si l'utilisateur a déjà like ou dislike le même bouton alors mettre à null
        UPDATE LIKE_DISLIKE SET est_like = null where (num_enchere,num_utilisateur) = (new.num_enchere,new.num_utilisateur);
    END;

DROP TRIGGER IF EXISTS like_insert2;
CREATE TRIGGER like_insert2 INSTEAD OF INSERT on LIKE_DISLIKE_VIEW FOR EACH ROW
    WHEN (select est_Like from LIKE_DISLIKE where (num_enchere,num_utilisateur) = (new.num_enchere,new.num_utilisateur))  <> new.est_like
    BEGIN 
        -- Si l'utilisateur a déjà like ou dislike un bouton différent alors update
        UPDATE LIKE_DISLIKE SET est_like = new.est_like where (num_enchere,num_utilisateur) = (new.num_enchere,new.num_utilisateur);
    END;

DROP TRIGGER IF EXISTS like_insert3;
CREATE TRIGGER like_insert3 INSTEAD OF INSERT on LIKE_DISLIKE_VIEW FOR EACH ROW
    BEGIN  
        -- INSERT normal
         INSERT INTO LIKE_DISLIKE(num_utilisateur,num_enchere,est_like) values(new.num_utilisateur,new.num_enchere,new.est_like);
    END;


INSERT INTO LIKE_DISLIKE_VIEW(num_enchere,num_utilisateur,est_like) values (1,2,1),(2,1,0),(2,3,1),(2,3,1),(2,4,1),(2,4,0);
*/
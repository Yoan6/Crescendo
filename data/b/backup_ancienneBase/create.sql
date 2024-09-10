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
DROP VIEW IF EXISTS GAGNE_VIEW;

DROP TABLE IF EXISTS ARTICLE;
DROP TABLE IF EXISTS ENCHERE;
DROP TABLE IF EXISTS UTILISATEUR;



CREATE TABLE IF NOT EXISTS UTILISATEUR  (
    num_utilisateur INTEGER PRIMARY KEY AUTOINCREMENT, -- CHANGEMENT
    email VARCHAR NOT NULL,                                      -- CHANGEMENT
    pseudo VARCHAR NOT NULL,
    mot_de_passe PASSWORD,
    nom VARCHAR,
    prenom VARCHAR,
    date_naissance DATE,
    ville VARCHAR,
    rue VARCHAR NULL,
    code_postal VARCHAR, 
    img_profil VARCHAR,
    UNIQUE(email)
);

CREATE TABLE IF NOT EXISTS ENCHERE (
    num_enchere INTEGER PRIMARY KEY AUTOINCREMENT, 
    date_debut DATE NOT NULL,
    est_lot BOOLEAN --Suppresion de prix et id_paiement mis dans ENCHERIT
); --Suppression de nombre de like, Une table intermédiaire ENTRE utilisateur et enchere sera créée plus tard

CREATE TABLE IF NOT EXISTS ARTICLE (
    num_article INTEGER PRIMARY KEY AUTOINCREMENT, 
    num_vendeur INTEGER REFERENCES Utilisateur(num_utilisateur) ON DELETE CASCADE, -- ajout 
    titre VARCHAR COLLATE NOCASE NOT NULL,
    prix_min INTEGER NOT NULL,
    description_article VARCHAR COLLATE NOCASE,
    artiste VARCHAR COLLATE NOCASE NOT NULL,
    etat VARCHAR COLLATE NOCASE,
    categorie VARCHAR COLLATE NOCASE,
    taille VARCHAR COLLATE NOCASE,
    date_evenement DATE COLLATE NOCASE,
    lieu VARCHAR COLLATE NOCASE,
    style VARCHAR COLLATE NOCASE,
    UNIQUE(titre,description_article)
);

------------------------------TABLES ASSOCIATION------------------------------




---------------ENTRE UTILISATEUR ET ENCHERE



CREATE TABLE IF NOT EXISTS ENCHERIT (
    num_utilisateur INTEGER references UTILISATEUR(num_utilisateur) ON DELETE CASCADE, 
    num_enchere INTEGER references ENCHERE(num_enchere) ON DELETE CASCADE,
    prix_offre INTEGER,             
    date_encherissement DATE,     
    id_paiement INTEGER,          
    PRIMARY KEY (num_utilisateur,num_enchere,prix_offre)
);


CREATE VIEW GAGNE_VIEW as select max(prix_offre), num_utilisateur, e.num_enchere, date_encherissement, id_paiement, en.date_debut
                    FROM ENCHERIT e natural join ENCHERE en
                    WHERE date_debut < datetime(DATE(), '-6 DAYS')
                    GROUP by num_enchere
                    limit 1;




CREATE TABLE IF NOT EXISTS FAVORISE (
    num_utilisateur INTEGER references UTILISATEUR(num_utilisateur) ON DELETE CASCADE, 
    num_enchere INTEGER references ENCHERE(num_enchere) ON DELETE CASCADE,
    est_favoris BOOLEAN,
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
.import ../../sql_base_donnees_actuelle/initialisation/favorise.initialisation.txt FAVORISE
.import ../../sql_base_donnees_actuelle/initialisation/like_dislike.initialisation.txt LIKE_DISLIKE
.import ../../sql_base_donnees_actuelle/initialisation/gagne.initialisation.txt GAGNE

.print '===========================  TESTS  ==========================='

SELECT * from ARTICLE;
.print

insert into UTILISATEUR values (9,'root@gmail.com','test',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
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
UPDATE ENCHERE SET date_debut = datetime(DATE(),'-6 DAYS') where num_enchere=18 OR num_enchere=1;

create VIEW ENCHERE_TOUT_EN_COURS_VIEW as select * from ENCHERE_TOUT_VIEW
    WHERE num_enchere IN (SELECT num_enchere FROM ENCHERE WHERE date_debut BETWEEN datetime(DATE(), '-6 DAYS') AND DATE());

/*INSERT INTO LIKE_DISLIKE(num_enchere,num_utilisateur,est_like) values (1,2,1),(2,1,0),(4,1,0),(4,2,0),(4,3,0);*/


UPDATE ENCHERE SET date_debut = datetime(DATE(),'-7 DAYS') where num_enchere=20;
UPDATE ENCHERE SET date_debut = datetime(DATE(),'+1 DAYS') where num_enchere=21;

/**************************************
**  Génération des tables Utiliser la commande (sur sqlite)   
**
** .read create.sql
**
**************************************/
DROP TABLE UTILISATEUR;

CREATE TABLE UTILISATEUR (
    email VARCHAR primary key,
    pseudo VARCHAR,
    mot_de_passe PASSWORD,
    nom VARCHAR,
    prenom VARCHAR,
    date_naissance TIME,
    ville VARCHAR,
    rue VARCHAR NULL,
    code_postal VARCHAR 
);


/**************************************
**  Autres
**************************************/
.separator ROW "\n"
.separator '|'
.nullvalue estNull

.import utilisateurs.txt UTILISATEUR


insert into UTILISATEUR values ('root@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
SELECT * from UTILISATEUR;
SELECT * from UTILISATEUR where rue is NULL;
--.quit;
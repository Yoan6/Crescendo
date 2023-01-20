# Crescendo

## Comment accéder aux site hébergé sur le serveur :
Mettre dans l'URL d'un naviguateur : 192.168.14.231 puis naviguez dans notre site.

## Test en local :
Si vous décidez de tester en local, il va falloir que vous rentriez dans un terminal : git clone https://gricad-gitlab.univ-grenoble-alpes.fr/iut2-info-stud/2022-s3/s3.01/team-10/crescendo.git. 

Ensuite, vous devez changez les droits pour que le site accède aux images sans problèmes : chmod -R o+wx data.

Ensuite, vous devez générer la base de donnée actuelle :

    - chemin relatif de la base de donnée : 
    /crescendo/data/b/backup_ancienneBase/
    
    - ouvrez la base de donnée : 
    sqlite3 crescendo.db
    
    - chargez la base de donnée : 
    .read create.sql

## Compte test
Vous pouvez utilisez le compte test pour tester les fonctionnalité de notre site (si vous n'êtes pas connecté vous n'accédez pas à toute les fonctionnalités).

Pseudo : Test

Password : azertyuiopqs

## Compte fonctionnel
En cas d'échec de connexion avec le compte test, vous pouvez soit créer un nouveau compte en vous inscivant soit vous utilisez le compte suivant :

Adresse mail : yoan.delannoy@gmail.com

Password : azertyuiopqs

## Erreur :
En cas d'erreur, essayer de recharger la base de donnée avec les instructions juste au dessus

## Autres :
Les articles flash correspondent aux articles se terminant dans les 24h et ayant le plus de likes.

Les articles ne sont pas affichés dans le catalogue tant que la date de début n'est pas encore arrivée.

Une enchère dure 7 jours.

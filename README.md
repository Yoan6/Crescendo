# Crescendo

Ceci est un site web réalisé durant ma deuxième année universitaire qui est un site web de vente aux enchères réalisé en groupe de 6.
Il permet de participer à des ventes aux enchères mais également d'en créer avec des comptes acheteurs et des comptes vendeurs.


## Comment accéder aux site hébergé sur le serveur :
Mettre dans l'URL d'un naviguateur : 192.168.14.231 puis naviguez dans notre site.
Le site a été prévu initialement pour fonctionner sur un serveur local à l'IUT donc ne fonctionnera pas en dehors.

## Test en local :
Si vous décidez de tester en local, il va falloir que vous rentriez dans un terminal :

```bash
git clone https://github.com/Yoan6/crescendo.git.
```

Ensuite, vous devez changez les droits pour que le site accède aux images sans problèmes :

```bash
chmod -R o+wx data.
```

Ensuite, vous devez générer la base de donnée actuelle :

- placez vous au niveau de la base de données :

```bash
cd crescendo/data/b/backup_ancienneBase/
```

- ouvrez la base de donnée :

```bash
sqlite3 crescendo.db
```

- chargez la base de donnée :

```bash
.read create.sql
```

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

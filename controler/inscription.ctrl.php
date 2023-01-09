<?php
// 
// Inclusion du framework
include_once(__DIR__."/../framework/view.class.php");
// Inclusion du modèle
include_once(__DIR__."/../model/Utilisateur.class.php");



///////////////////////////////////////////////////////////////////////////////
// Partie récupération des données
///////////////////////////////////////////////////////////////////////////////

$prenom = $_POST['prenom'] ?? '';
$nom = $_POST['nom'] ?? '';
$pseudo = $_POST['pseudo'] ?? '';
$birthsday = $_POST['birthsday'] ?? '';
$rue = $_POST['rue'] ?? '';
$code_postale = $_POST['code_postale'] ?? '';
$ville = $_POST['ville'] ?? '';
$adresseMail = $_POST['adresseMail'] ?? '';
$password = $_POST['mdp'] ?? '';
$verifmdp = $_POST['verifmdp'] ?? '';

///////////////////////////////////////////////////////////////////////////////
// Partie calculs avec le modèle
///////////////////////////////////////////////////////////////////////////////

// Test pour afficher les erreurs
// On ne gère pas les erreurs si l'utilisateur de remplit pas un champs car 
// s'il accède à ce controlleur c'est qu'il a forcément remplit les champs
// grâce à l'attribut required du formulaire html

$error=array();
if ($birthsday > DateTime()-18) {
  $error[] = "L'utilisateur doit avoir au moins 18 ans";
}
if ($verifmdp != $password) {
  $error[] = "Le mot de passe n'est pas confirmé 2 fois";
}

if (count($error) == 0) {
  // Création d'un nouvel utilisateur :
  $utilisateur = new Utilisateur($adresseMail,$pseudo,$password,$nom,$prenom,$ville,$rue,$code_postale);
  try {
    $utilisateur->create();
  }
  catch (Exception $e) {
    $error = $e->getMessage();
  }
}


// Si finalement aucune erreur, on envois le message Ok et l'utilisateur est connecté
if (count($error) == 0) {
  $message = "L'utilisateur a correctement été inséré dans la base";
  session_start();
  $_SESSION['connected'] = true;
} else {
  $message = '';
}


////////////////////////////////////////////////////////////////////////////
// Construction de la vue
////////////////////////////////////////////////////////////////////////////
$view = new View();

// Charge la vue
if ($_SESSION['connected'] == true) {
    $view->display("accueil.php");
  } 
  else {
    $view->display("inscription.php");
}
?>
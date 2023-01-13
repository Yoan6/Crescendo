<?php
// 
// Inclusion du framework
include_once(__DIR__."/../framework/view.class.php");
// Inclusion du modèle
include_once(__DIR__."/../model/Utilisateur.class.php");
// Inclusion du DAO
require_once(__DIR__ . '/../model/DAO.class.php');



///////////////////////////////////////////////////////////////////////////////
// Partie récupération des données
///////////////////////////////////////////////////////////////////////////////

$prenom = $_POST['prenom'] ?? '';
$nom = $_POST['nom'] ?? '';
$pseudo = $_POST['pseudo'] ?? '';
$birthsday = $_POST['birthsday'] ?? '';
$birthsday = new DateTime($birthsday);
$rue = $_POST['rue'] ?? '';
$code_postale = $_POST['code_postale'] ?? '';
$ville = $_POST['ville'] ?? '';
$adresseMail = $_POST['adresseMail'] ?? '';
$password = $_POST['mdp'] ?? '';
$password = password_hash($password, PASSWORD_DEFAULT);
$verifmdp = $_POST['verifmdp'] ?? '';


///////////////////////////////////////////////////////////////////////////////
// Partie calculs avec le modèle
///////////////////////////////////////////////////////////////////////////////

// Test pour afficher les erreurs
// On ne gère pas les erreurs si l'utilisateur de remplit pas un champs car 
// s'il accède à ce controlleur c'est qu'il a forcément remplit les champs
// grâce à l'attribut required du formulaire html

if(!isset($_SESSION)) { 
    session_start(); 
} 
// Si l'utilisateur est déja connecté on l'envoie sur la page accueil.php
if(isset($_SESSION['num_utilisateur'])) {
    $view = new View();

    // Charge la vue
    $view->display("accueil.php");
    echo ("Vous êtes déja connecté !");
} 

$error=array();

$dateDeCreation = new DateTime();
$dateMinimale = new DateTime();   // date d'aujourd'hui
$interval = new DateInterval('P18Y');   // intervalle de temps à changer : 18 ans
$dateMinimale->sub($interval);    // date minimale : aujourd'hui - 18 ans
if ($birthsday > $dateMinimale->format('d/m/y')) {
  $error[] = new Exception("L'utilisateur doit avoir au moins 18 ans");
}
if ($verifmdp != $password) {
  $error[] = new Exception("Le mot de passe n'est pas confirmé 2 fois");
}

// Vérification s'il n'existe pas déja un utilisateur avec ce pseudo :
if (count($error) == 0) {
  try {
    $utilisateur = Utilisateur::read($pseudo, $password);
  }
  catch (Exception $e) {
    array_push($error,$e->getMessage());
  }
}
  
  
  if (count($error) == 0) {
  // Création d'un nouvel utilisateur :
  $utilisateur = new Utilisateur($adresseMail,$pseudo,$password,$nom,$prenom,$ville,$rue,$code_postale,$dateDeCreation);
  try {
    $utilisateur->create();
  }
  catch (Exception $e) {
    array_push($error,$e->getMessage());
  }
}




// Si finalement aucune erreur, on envois un message de connexion et l'utilisateur est connecté
if (count($error) == 0) {
  $message = "L'utilisateur a correctement été inséré dans la base";
  session_start();
  $_SESSION['num_utilisateur'] = $utilisateur->getNumUtilisateur();
  $view = new View();

    // Charge la vue
    $view->display("../view/accueil.php");
    echo ("Vous êtes connecté !");
} else {
  $message = '';
}



////////////////////////////////////////////////////////////////////////////
// Construction de la vue
////////////////////////////////////////////////////////////////////////////
$view = new View();
$view->assign('error',$error);


// Charge la vue
$view->display("../view/inscription.php");
?>
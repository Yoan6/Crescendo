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
$verifmdp = $_POST['verifmdp'] ?? '';
$inscription = $_POST['inscription'] ?? '';


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
    $view->display("accueil.view.php");
} 

$errors=array();




$dateMinimale = new DateTime();   // date d'aujourd'hui
$interval = new DateInterval('P18Y');   // intervalle de temps à changer : 18 ans
$dateMinimale->sub($interval);    // date minimale : aujourd'hui - 18 ans

if ($birthsday > $dateMinimale) {
  $errors[] = new Exception("L'utilisateur doit avoir au moins 18 ans");
}
if ($verifmdp != $password) {
  $errors[] = new Exception("Le mot de passe n'est pas confirmé 2 fois");
}

// On hash le mot de passe :
$password = password_hash($password, PASSWORD_DEFAULT);


// Vérification s'il n'existe pas déja un utilisateur avec ce pseudo 
// Si non, on crée l'utilisateur :
  if (count($errors) == 0) {
    try {
      $utilisateur = Utilisateur::read($pseudo, $password);
      array_push($errors,"Il y a déjà un utilisateur avec ce pseudo ou email");
    }
    catch (Exception $e) {
      $utilisateur = new Utilisateur($adresseMail,$pseudo,$password,$nom,$prenom,$ville,$rue,$code_postale,$birthsday);
      $utilisateur->create();
    }
  }




// Si finalement aucune erreur, on envois un message de connexion et l'utilisateur est connecté
if (count($errors) == 0) {
  $_SESSION['num_utilisateur'] = $utilisateur->getNumUtilisateur();
  $view = new View();

    // Charge la vue
    $view->assign('errors', $errors);
    $view->display("../view/accueil.view.php");
}

// On traite le moment où l'utilisateur veut s'inscrire en venant d'ailleurs
if ($inscription != 'confirmer') {
$errors = array();
}

////////////////////////////////////////////////////////////////////////////
// Construction de la vue
////////////////////////////////////////////////////////////////////////////
$view = new View();
$view->assign('prenom',$prenom);
$view->assign('nom',$nom);
$view->assign('pseudo',$pseudo);
$view->assign('birthsday',$birthsday->format('Y-m-d'));
$view->assign('rue',$rue);
$view->assign('code_postale',$code_postale);
$view->assign('ville',$ville);
$view->assign('adresseMail',$adresseMail);
$view->assign('errors',$errors);


// Charge la vue
$view->display("../view/inscription.php");

?>
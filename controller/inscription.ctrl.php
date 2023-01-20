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

// Récuperation des données de l'utilisateur et encodage avec la fonction htmlspecialchars() pour éviter les attaques XSS
$prenom = htmlspecialchars($_POST['prenom'] ?? '');
$nom = htmlspecialchars($_POST['nom'] ?? '');
$pseudo = htmlspecialchars($_POST['pseudo'] ?? '');
$birthsday = $_POST['birthsday'] ?? '';
$birthsday = new DateTime($birthsday);
$rue = htmlspecialchars($_POST['rue'] ?? '');
$code_postale = htmlspecialchars($_POST['code_postale'] ?? '');
$ville = htmlspecialchars($_POST['ville'] ?? '');
$adresseMail = htmlspecialchars($_POST['adresseMail'] ?? '');
$password = htmlspecialchars($_POST['mdp'] ?? '');
$verifmdp = htmlspecialchars($_POST['verifmdp'] ?? '');
$inscription = htmlspecialchars($_POST['inscription'] ?? '');


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
  header('Location: accueil.ctrl.php');
} 

$dateMinimale = new DateTime();   // date d'aujourd'hui
$interval = new DateInterval('P18Y');   // intervalle de temps à changer : 18 ans
$dateMinimale->sub($interval);    // date minimale : aujourd'hui - 18 ans


// Si l'utilisateur n'est pas encore inscrit il ne doit pas il y avoir de message d'erreur :
if ($inscription == 'confirmer') {
  $errors = array();
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
    header('Location: accueil.ctrl.php');
  }

}
else {
  $errors = array();
}



////////////////////////////////////////////////////////////////////////////
// Construction de la vue
////////////////////////////////////////////////////////////////////////////
$view = new View();

$view->assign('dateMinimale',$dateMinimale->format('Y-m-d'));
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
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

var_dump($password);


///////////////////////////////////////////////////////////////////////////////
// Partie calculs avec le modèle
///////////////////////////////////////////////////////////////////////////////

// Test pour afficher les erreurs
// On ne gère pas les erreurs si l'utilisateur de remplit pas un champs car 
// s'il accède à ce controlleur c'est qu'il a forcément remplit les champs
// grâce à l'attribut required du formulaire html

$error=array();

$dateMinimale = new DateTime();   // date d'aujourd'hui
$interval = new DateInterval('P18Y');   // intervalle de temps à changer : 18 ans
$dateMinimale->sub($interval);    // date minimale : aujourd'hui - 18 ans
if ($birthsday > $dateMinimale->format('d/m/y')) {
  $error[] = ["L'utilisateur doit avoir au moins 18 ans"];
}
if ($verifmdp != $password) {
  $error[] = ["Le mot de passe n'est pas confirmé 2 fois"];
}

// Vérification s'il n'existe pas déja un utilisateur avec ce pseudo :
  if ($utilisateur)

$header="MIME-Version: 1.0\r\n";
$header.='From:"[VOUS]"<votremail@mail.com>'."\n";
$header.='Content-Type:text/html; charset="uft-8"'."\n";
$header.='Content-Transfer-Encoding: 8bit';
$message='
<html>
  <body>
      <div align="center">
        <a href="http://localhost/crescendo/view/inscription.php?pseudo='.urlencode($pseudo).'&adresseMail='.$adresseMail.'">Confirmez votre compte !</a>
        
      </div>
  </body>
</html>
';
mail($adresseMail, "Confirmation de compte", $message, $header);


if (count($error) == 0) {
  // Création d'un nouvel utilisateur :
  $utilisateur = new Utilisateur($adresseMail,$pseudo,$password,$nom,$prenom,$ville,$rue,$code_postale);
  try {
    $utilisateur->create();
  }
  catch (Exception $e) {
    array_push($error,$e->getMessage());
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
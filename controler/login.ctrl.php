<?php
// 
// Inclusion du framework
include_once(__DIR__."/../framework/view.class.php");
include_once(__DIR__."/../model/Utilisateur.class.php");



///////////////////////////////////////////////////////////////////////////////
// Partie récupération des données
///////////////////////////////////////////////////////////////////////////////

$login = $_POST['login'] ?? '';
$password = $_POST['password'] ?? '';

///////////////////////////////////////////////////////////////////////////////
// Partie calculs avec le modèle
///////////////////////////////////////////////////////////////////////////////


if ($login != '' && $password != '') {
    if (Utilisateur.read($login,$password) !=null) {
        $connected = true;
    }
    else {
        $connected = false;
    }
} else {
  $connected = false;
}

session_start();
$_SESSION['connected'] = $connected;


// 

////////////////////////////////////////////////////////////////////////////
// Construction de la vue
////////////////////////////////////////////////////////////////////////////
$view = new View();

// Charge la vue
if ($_SESSION['connected'] == true) {
    $view->display("accueil.php");
  } 
  else {
    $view->display("login.php");
}
?>
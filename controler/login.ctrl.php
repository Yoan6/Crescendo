<?php
// 
// Inclusion du framework
include_once(__DIR__."/../framework/view.class.php");
include_once(__DIR__."/../model/Utilisateur.class.php");

if(!isset($_SESSION)) { 
    session_start(); 
} 

///////////////////////////////////////////////////////////////////////////////
// Partie récupération des données
///////////////////////////////////////////////////////////////////////////////

$login = $_POST['login'] ?? '';
$password = $_POST['password'] ?? '';

///////////////////////////////////////////////////////////////////////////////
// Partie calculs avec le modèle
///////////////////////////////////////////////////////////////////////////////

$error = array();

// Si le login ou l'utilisateur ne sont pas fournis :
if ($login != '' && $password != '') {
    // Tentative de lecture d'un utilisateur en fonction du login/email et du mot de passe
    try {
        $utilisateur = Utilisateur::readHash($login);
        $_SESSION['num_utilisateur'] = $utilisateur->getNumUtilisateur();

        // Teste si le mot de passe encrypté est bon :
        $passwordHash = $utilisateur->getMotDePasse();
        if (password_verify($password, $passwordHash)) {
            $view = new View();
    
            // Charge la vue
            $view->display("accueil.php");
            echo ("Vous êtes maintenant connecté !");
        }
        else {
            array_push($error, "L'identifiant ou le mot de passe n'est pas bon");
        }

        
    } catch (Exception $e) {
        array_push($error,$e->getMessage());
    }

} else {
    array_push($error, "Vous n'avez pas rentré de login ou mot de passe");
}


$view = new View();
$view->assign('error',$error);
    
// Charge la vue
$view->display("login.php");

?>
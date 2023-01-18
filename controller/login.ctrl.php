<?php
// 
// Inclusion du framework
include_once(__DIR__."/../framework/view.class.php");
include_once(__DIR__."/../model/Utilisateur.class.php");

if(!isset($_SESSION)) { 
    session_start(); 
} 

// Si l'utilisateur est déjà connecté, on le redirige vers la page d'accueil :

if (isset($_SESSION['num_utilisateur'])) {
    header("Location: ../controller/accueil.ctrl.php");
}

    ///////////////////////////////////////////////////////////////////////////////
    // Partie récupération des données
    ///////////////////////////////////////////////////////////////////////////////

    $login = htmlspecialchars($_POST['login'] ?? '');
    $password = htmlspecialchars($_POST['password'] ?? '');

    ///////////////////////////////////////////////////////////////////////////////
    // Partie calculs avec le modèle
    ///////////////////////////////////////////////////////////////////////////////


    $errors = array();

    // Si le login ou l'utilisateur ne sont pas fournis :
    if ($login != '' && $password != '') {
        // Tentative de lecture d'un utilisateur en fonction du login/email et du mot de passe
        try {
            $utilisateur = Utilisateur::readHash($login);
            
            // Teste si le mot de passe encrypté est bon :
            $passwordHash = $utilisateur->getMotDePasse();
            if (password_verify($password, $passwordHash)) {
                $_SESSION['num_utilisateur'] = $utilisateur->getNumUtilisateur();
                header("Location: ../controller/parametre.ctrl.php");
            }
            else {
                array_push($errors, "L'identifiant ou le mot de passe n'est pas bon");
            }

            
        } catch (Exception $e) {
            array_push($errors,$e->getMessage());
        }

    } else {
        array_push($errors, "Vous n'avez pas rentré de login ou mot de passe");
    }

    $view = new View();
    $view->assign('login',$login);
    $view->assign('errors',$errors);
        
    // Charge la vue
    $view->display("login.php");

?>
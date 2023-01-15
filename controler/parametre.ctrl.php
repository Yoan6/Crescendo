<?php
// 
// Inclusion du framework
include_once(__DIR__."/../framework/view.class.php");
include_once(__DIR__."/../model/Utilisateur.class.php");

if(!isset($_SESSION)) { 
    session_start(); 
} 

$error = array();




// Variable de champs du formulaire :
$pseudo = $_POST['pseudo'] ?? '';
$mail = $_POST['mail'] ?? '';
$password = $_POST['password'] ?? '';
$postal = $_POST['postal'] ?? '';
$ville = $_POST['ville'] ?? '';
$adresse = $_POST['adresse'] ?? '';
$ancienPassword = $_POST['ancienPassword'] ?? '';
$nouveauPassword = $_POST['nouveauPassword'] ?? '';
$checkPassword = $_POST['checkPassword'] ?? '';

// Cas où l'utilisateur vient pour la première fois sur la page :
if ($pseudo == '' && $mail == '' && $password == '' && $postal == '' && $ville == '' && $adresse == '' && $ancienPassword == '' && $nouveauPassword == '' && $checkPassword == '') {
    
    // On initialise le mot de passe qui sera peut être changé par la suite :
    $utilisateur = Utilisateur::readNum($_SESSION['num_utilisateur']);
    $nouveauPassword = password_verify($password, $utilisateur->getMotDePasse());
    
    $pseudo = $utilisateur->getPseudo();
    $mail = $utilisateur->getEmail();
    $password = $utilisateur->getMotDePasse();
    $postal = $utilisateur->getCodePostal();
    $ville = $utilisateur->getVille();
    $adresse = $utilisateur->getRue();

    $view = new View();
    $_SESSION['pseudo'] = $pseudo;
    $_SESSION['mail'] = $mail;
    $_SESSION['password'] = $password;
    $_SESSION['postal'] = $postal;
    $_SESSION['ville'] = $ville;
    $_SESSION['adresse'] = $adresse;
    $_SESSION['nouveauPassword'] = $nouveauPassword;
    $view->display("parametres.php");

}

// Cas où l'utilisateur vient de valider un des formulaires :

else {

    // On change le pseudo :
    $utilisateur = Utilisateur::readNum($_SESSION['num_utilisateur']);

    if ($pseudo != '') {
        // On vérifie si le pseudo est différent de celui déjà enregistré :
        if ($pseudo != $utilisateur->getPseudo()) {
            $utilisateur->setPseudo($pseudo);

            $view = new View();
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['mail'] = $mail;
            $_SESSION['password'] = $password;
            $_SESSION['postal'] = $postal;
            $_SESSION['ville'] = $ville;
            $_SESSION['adresse'] = $adresse;
            $_SESSION['nouveauPassword'] = $nouveauPassword;
            $view->display("parametres.php");
        }
        else {
            array_push($error,"Le pseudo est le même que celui déjà enregistré");
        }
    }
    else {
        array_push($error,"Le pseudo ne peut pas être vide");
    }


    // On change le mail :
    $utilisateur = Utilisateur::readNum($_SESSION['num_utilisateur']);

    if ($mail != '' && $password != '') {
        // On vérifie si le mail est différent de celui déjà enregistré :
        if ($mail != $utilisateur->getEmail()) {
            // Test si le mot de passe est bon :
            $passwordHash = $utilisateur->getMotDePasse();
            if (password_verify($passwordHash, $password)) {
                $utilisateur->setEmail($mail);

                $view = new View();
                $_SESSION['pseudo'] = $pseudo;
                $_SESSION['mail'] = $mail;
                $_SESSION['password'] = $password;
                $_SESSION['postal'] = $postal;
                $_SESSION['ville'] = $ville;
                $_SESSION['adresse'] = $adresse;
                $_SESSION['nouveauPassword'] = $nouveauPassword;
                $view->display("parametres.php");
            }
            else {
                array_push($error, "L'identifiant ou le mot de passe n'est pas bon");
            }
        }
        array_push($error, "Le mail est le même que celui déjà enregistré");
    }


    // On change l'adresse postale :
    $utilisateur = Utilisateur::readNum($_SESSION['num_utilisateur']);

    if ($postal != '' && $ville != '' && $adresse != '') {
        // On vérifie si l'adresse psotale est différente de celle déjà enregistrée :
        if ($postal != $utilisateur->getCodePostal() || $ville != $utilisateur->getVille() || $adresse != $utilisateur->getRue()) {
            $utilisateur->setVille($ville);
            $utilisateur->setCodePostal($postal);
            $utilisateur->setRue($adresse);

            $view = new View();
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['mail'] = $mail;
            $_SESSION['password'] = $password;
            $_SESSION['postal'] = $postal;
            $_SESSION['ville'] = $ville;
            $_SESSION['adresse'] = $adresse;
            $_SESSION['nouveauPassword'] = $nouveauPassword;
            $view->display("parametres.php");
        }
        else {
            array_push($error,"L'adresse postale est la même que celle déjà enregistrée");
        }
    }
    else {
        array_push($error,"L'adresse postale ne peut pas être vide");
    }



    // On change le mot de passe :
    $utilisateur = Utilisateur::readNum($_SESSION['num_utilisateur']);

    if ($ancienPassword != '' && $nouveauPassword != '' && $checkPassword != '') {
        
        // On vérifie si le mot de passe est bon :
        if (password_verify($utilisateur->getMotDePasse(), $ancienPassword)) {
            // On vérifie si les deux mots de passe sont identiques :
            if ($nouveauPassword == $checkPassword) {
                // On vérifie si le nouveau mot de passe est différent de l'ancien :
                if ($nouveauPassword != $ancienPassword) {
                    $nouveauPassword = password_hash($nouveauPassword, PASSWORD_DEFAULT);
                    $utilisateur->setMotDePasse($nouveauPassword);

                    $view = new View();
                    $_SESSION['pseudo'] = $pseudo;
                    $_SESSION['mail'] = $mail;
                    $_SESSION['password'] = $password;
                    $_SESSION['postal'] = $postal;
                    $_SESSION['ville'] = $ville;
                    $_SESSION['adresse'] = $adresse;
                    $_SESSION['nouveauPassword'] = $nouveauPassword;
                    $view->display("parametres.php");
                }
                else {
                    array_push($error, "Le nouveau mot de passe doit être différent de l'ancien");
                }
            }
            else {
                array_push($error, "Les deux mots de passe ne sont pas identiques");
            }
        }
        else {
            array_push($error, "L'ancien mot de passe n'est pas bon");
        }
    }
    else {
        array_push($error,"Au moins un des mots de passe est vide");
    }


    // On assigne les variables à la vue :
    $view = new View();
    $_SESSION['pseudo'] = $utilisateur->getPseudo();
    $_SESSION['mail'] = $utilisateur->getEmail();
    $_SESSION['password'] = $utilisateur->getMotDePasse();
    $_SESSION['postal'] = $utilisateur->getCodePostal();
    $_SESSION['ville'] = $utilisateur->getVille();
    $_SESSION['adresse'] = $utilisateur->getRue();
    $_SESSION['nouveauPassword'] = $utilisateur->getMotDePasse();
    $view->assign('error',$error);
    $view->display("parametres.php");
}

var_dump($error);
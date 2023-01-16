<?php
// 
// Inclusion du framework
include_once(__DIR__."/../framework/view.class.php");
include_once(__DIR__."/../model/Utilisateur.class.php");

if(!isset($_SESSION)) { 
    session_start(); 
} 

$error = array();


$utilisateur = Utilisateur::readNum($_SESSION['num_utilisateur']);

// Variable de champs du formulaire :
$pseudo = $_POST['pseudo'] ?? $utilisateur->getPseudo();
$mail = $_POST['mail'] ?? $utilisateur->getEmail();
$password = $_POST['password'] ?? $utilisateur->getMotDePasse();
$postal = $_POST['postal'] ?? $utilisateur->getCodePostal();
$ville = $_POST['ville'] ?? $utilisateur->getVille();
$adresse = $_POST['adresse'] ?? $utilisateur->getRue();
$effacer = $_POST['effacer'] ?? '';
$confirmer = $_POST['confirmer'] ?? '';

$ancienPassword = $_POST['ancienPassword'] ?? '';
$nouveauPassword = $_POST['nouveauPassword'] ?? '';
$checkPassword = $_POST['checkPassword'] ?? '';



// On change le pseudo :

if ($confirmer == 'pseudo') {
    // On vérifie si le pseudo est différent de celui déjà enregistré :
    if ($pseudo != $utilisateur->getPseudo()) {
        $utilisateur->setPseudo($pseudo);

    }
    else {
        array_push($error,"Le pseudo est le même que celui déjà enregistré");
    }
}

// On change le mail :

if ($confirmer == 'mail') {
    // On vérifie si le mail est différent de celui déjà enregistré :
    if ($mail != $utilisateur->getEmail()) {
        // Test si le mot de passe est bon :
        $passwordHash = $utilisateur->getMotDePasse();
        if (password_verify($passwordHash, $password)) {
            $utilisateur->setEmail($mail);
        }
        else {
            array_push($error, "L'identifiant ou le mot de passe n'est pas bon");
        }
    }
    array_push($error, "Le mail est le même que celui déjà enregistré");
}


// On change l'adresse postale :

if ($confirmer == 'adresseMail') {
    // On vérifie si l'adresse psotale est différente de celle déjà enregistrée :
    if ($postal != $utilisateur->getCodePostal() || $ville != $utilisateur->getVille() || $adresse != $utilisateur->getRue()) {
        $utilisateur->setVille($ville);
        $utilisateur->setCodePostal($postal);
        $utilisateur->setRue($adresse);
    }
    else {
        array_push($error,"L'adresse postale est la même que celle déjà enregistrée");
    }
}



// On change le mot de passe :

if ($confirmer == 'password') {
    
    // On vérifie si le mot de passe est bon :
    if (password_verify($utilisateur->getMotDePasse(), $ancienPassword)) {
        // On vérifie si les deux mots de passe sont identiques :
        if ($nouveauPassword == $checkPassword) {
            // On vérifie si le nouveau mot de passe est différent de l'ancien :
            if ($nouveauPassword != $ancienPassword) {
                $nouveauPassword = password_hash($nouveauPassword, PASSWORD_DEFAULT);
                $utilisateur->setMotDePasse($nouveauPassword);
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

// Cas où l'utilisateur veut supprimer son compte :
if ($effacer == 'effacer') {
    $utilisateur->delete();
    session_destroy();
    $view = new View();
    $view->display("accueil.view.php");
}

if (count($error) == 0) {
    $utilisateur->update();
}

// On assigne les variables à la vue :
$view = new View();

$view->assign('pseudo', $pseudo);
$view->assign('mail', $mail);
$view->assign('password', $password);
$view->assign('postal', $postal);
$view->assign('ville', $ville);
$view->assign('adresse', $adresse);

$view->assign('error',$error);
$view->display("parametres.php");


var_dump($error);
var_dump($_SESSION['num_utilisateur']);
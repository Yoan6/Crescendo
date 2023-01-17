<?php
// 
// Inclusion du framework
include_once(__DIR__."/../framework/view.class.php");
include_once(__DIR__."/../model/Utilisateur.class.php");

if(!isset($_SESSION)) { 
    session_start(); 
} 

$errors = array();


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

// Lien relatif vers le dossier des images :
$chemin_image  =__DIR__."/../data/imgProfil/";

// On modifie l'image de profil de l'utilisateur :
if(isset($_FILES['fichier'])) {
    $file = $_FILES['fichier'];
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];
    $file_ext = explode('.', $file_name);
    $file_ext = strtolower(end($file_ext));

    $allowed = array('jpg', 'jpeg', 'png');

    if(in_array($file_ext, $allowed)) {
        if($file_error === 0) {
            if($file_size <= 2097152) {
                // L'utilisateur veut changer son image de profil :
                $utilisateur->setImgProfil($chemin_image.$file_name);
                $utilisateur->update();
            } else {
                echo "La taille du fichier ne doit pas dépasser 2 Mo.";
            }
        } else {
            echo "Il y a eu un problème lors du téléchargement du fichier.";
        }
    } else {
        echo "Seuls les formats de fichier JPG, JPEG, PNG sont autorisés.";
    }
}

//Cas oùl'utilisateur veut effacer son image de profil :

if ($confirmer == 'effacer') {
    $utilisateur->setImgProfil($chemin_image."/img_profile_default.png");
    $utilisateur->update();
}


// On change le pseudo :

if ($confirmer == 'pseudo') {
    // On vérifie si le pseudo est différent de celui déjà enregistré :
    if ($pseudo != $utilisateur->getPseudo()) {
        $utilisateur->setPseudo($pseudo);
    }
    else {
        array_push($errors,"Le pseudo est le même que celui déjà enregistré");
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
            array_push($errors, "L'identifiant ou le mot de passe n'est pas bon");
        }
    }
    array_push($errors, "Le mail est le même que celui déjà enregistré");
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
        array_push($errors,"L'adresse postale est la même que celle déjà enregistrée");
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
                array_push($errors, "Le nouveau mot de passe doit être différent de l'ancien");
            }
        }
        else {
            array_push($errors, "Les deux mots de passe ne sont pas identiques");
        }
    }
    else {
        array_push($errors, "L'ancien mot de passe n'est pas bon");
    }
}

// Cas où l'utilisateur veut supprimer son compte :
if ($effacer == 'effacer') {
    $utilisateur->delete();
    session_destroy();
    header("Location: accueil.ctrl.php");
}

if (count($errors) == 0) {
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

$view->assign('errors',$errors);
$view->display("parametres.php");


var_dump($errors);
var_dump($_SESSION['num_utilisateur']);
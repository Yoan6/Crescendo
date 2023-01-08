<?php
require_once(__DIR__ . '/../model/Utilisateur.class.php');
require_once(__DIR__ . '/../test/helper.php');

$utilisateur = new Utilisateur("emailTest","pseudo","motDePasse","nom","prenom","ville","rue","codePostal");
try {
    //--Test--
    print("Création d'un Utilisateur : ");
    $utilisateur->create();
    OK();

    // --Test--
    print("Lecture d'un Utilisateur : ");
    $utilisateur2 = Utilisateur::read($utilisateur->getEmail(), $utilisateur->getMotDePasse());
    if(!$utilisateur->egalUtilisateur($utilisateur2)) {throw new Exception("pas le bon utilisateur");};
    OK();

    // --Test--
    print("Update d'un Utilisateur : ");
    $utilisateur->setMotDePasse("nouveauMDP");
    $utilisateur->update();
    if($utilisateur->egalUtilisateur($utilisateur2)) {throw new Exception("utilisateur pas modifié");};
    OK();

    // --Test--
    print("Suppression d'un Utilisateur : ");
    $utilisateur->delete();
    OK();

} catch (Exception $e) {
    notOK();
    $dao->query("DELETE FROM UTILISATEUR WHERE email=?;", [$utilisateur->getEmail()]);
    exit('\nErreur ' . $e->getMessage() . "\n");
}






?>
<?php
require_once(__DIR__ . '/../model/Utilisateur.class.php');
require_once(__DIR__ . '/../test/classeFormatage/helper.php');

$utilisateur = new Utilisateur("emailTest","pseudo","motDePasse","nom","prenom","ville","rue","codePostal");
try {
    //--Test--
    print("Création d'un Utilisateur : ");
    $utilisateur->create();
    OK();

    // --Test--
    print("Lecture d'un Utilisateur : ");
    $utilisateur2 = Utilisateur::read($utilisateur->getEmail(), $utilisateur->getMotDePasse());
    if(!$utilisateur->egalUtilisateur($utilisateur2)) 
    {
        var_dump("\n\nValeurs u1", $utilisateur,"\n\nValeurs u2 avec read", $utilisateur2); 
        throw new Exception("pas le bon utilisateur");
    };
    OK();

    // --Test--
    print("Update d'un Utilisateur : ");
    $utilisateur->setMotDePasse("nouveauMDP");
    $utilisateur->update();
    $utilisateur2 = Utilisateur::read($utilisateur->getEmail(), $utilisateur->getMotDePasse()); // Lecture avec la base de données
    if(!$utilisateur->egalUtilisateur($utilisateur2)) 
    {                                         // Pour savoir si les valeurs en base ont bien étés changées
        var_dump("\n\nValeurs non modifiées", $utilisateur,"\n\nValeurs après modification", $utilisateur2); 
        ;throw new Exception("utilisateur pas modifié");
    };
    OK();

    // --Test--
    print("Suppression d'un Utilisateur : ");
    $utilisateur->delete();
    OK();

} catch (Exception $e) {
    notOK();
    $dao = DAO::get();
    $dao->query("DELETE FROM UTILISATEUR WHERE email=?;", [$utilisateur->getEmail()]);
    exit('\nErreur ' . $e->getMessage() . "\n");
}






?>
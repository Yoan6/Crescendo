<?php
require_once(__DIR__ . '/../model/Utilisateur.class.php');
require_once(__DIR__ . '/../test/classeFormatage/helper.php');

// Les dates ont besoin d'être au format ISO Y/m/d (par défaut normalement) pour la base de données
$utilisateur = new Utilisateur("emailTest","pseudo",$passwordTest = password_hash("motDePasse", PASSWORD_DEFAULT),"nom","prenom","ville","rue","codePostal",DateTime::createFromFormat('Y/m/d','2000/01/01'));
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
        ("\n\nValeurs u1", $utilisateur,"\n\nValeurs u2 avec read", $utilisateur2); 
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
        ("\n\nValeurs non modifiées", $utilisateur,"\n\nValeurs après modification", $utilisateur2); 
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
    $dao->exec("DELETE FROM Utilisateur WHERE email = ?;", [$utilisateur->getEmail()]);
    exit('\nErreur ' . $e->getMessage() . "\n");
}






?>
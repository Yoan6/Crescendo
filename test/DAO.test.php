<?php
require_once(__DIR__ . '/../model/Utilisateur.class.php');
require_once(__DIR__ . '/../test/classeFormatage/helper.php');


$valeurAttendu = [
    'email' => 'testDAO',
    0 => 'testDAO',
    'mot_de_passe' => 'testDAO',
    1 => 'testDAO',
];
try {
    //--Test--
    print("Création d'un DAO : ");
    $dao = DAO::get();
    OK();

    //--Test--
    print("Test exec du DAO : ");
    $dao->exec("INSERT INTO Utilisateur(email,mot_de_passe) values(?,?);",[$valeurAttendu['email'],$valeurAttendu['mot_de_passe']]);
    OK();

    //--Test--
    print("Lecture avec une query DAO : ");
    $table = $dao->query("SELECT email,mot_de_passe FROM UTILISATEUR WHERE email =?", [$valeurAttendu['email']]);
    if ($table[0] != $valeurAttendu) {
        var_dump("\n\nAttendue ", $valeurAttendu,"\n\nobtenue", $table[0]); 
        throw new Exception("Mauvaise lecture");};
    OK();

} catch (Exception $e) {
    notOK();
    print('\nErreur ' . $e->getMessage() . "\n");
}

try {
    $dao->exec("DELETE FROM UTILISATEUR WHERE email=?;", [$valeurAttendu['email']]);
} catch (Exception $e) {
    // Ne rien faire, car l'utilisateur n'est plus dans la base de données
}
?>
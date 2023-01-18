<?php
require_once(__DIR__ . '/../model/Utilisateur.class.php');
require_once(__DIR__ . '/../test/classeFormatage/helper.php');

$passwordTest = password_hash('testDAOD3', PASSWORD_DEFAULT);
$valeurAttendu = [
    'email' => 'testDAOD3',
    0 => 'testDAOD3',
    'mot_de_passe' => $passwordTest,
    1 => $passwordTest,
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
        ("\n\nAttendue ", $valeurAttendu,"\n\nobtenue", $table[0]); 
        throw new Exception("Mauvaise lecture");};
    OK();

} catch (Exception $e) {
    notOK();
    print('\nErreur ' . $e->getMessage() . "\n");
}

try {
    $dao->exec("DELETE FROM UTILISATEUR WHERE email=?;", [$valeurAttendu['email']]);
} catch (Exception | Error  $e) {
    // Ne rien faire, car l'utilisateur n'est plus dans la base de données
}
?>
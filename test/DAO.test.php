<?php
require_once(__DIR__ . '/../model/Utilisateur.class.php');
require_once(__DIR__ . '/../test/classeFormatage/helper.php');

$passwordTest = password_hash('testDAOD3', PASSWORD_DEFAULT);
$valeurAttendu = [
    'email' => 'testDAOD3@gmail.com',
    'pseudo' => 'testDAOD3',
    'mot_de_passe' => $passwordTest,
];

try {
    //--Test--
    print("Création d'un DAO : ");
    $dao = DAO::get();
    OK();

    //--Test--
    print("Test exec du DAO : ");
    $dao->exec("INSERT INTO Utilisateur(email,pseudo,mot_de_passe) values(?,?,?);",[$valeurAttendu['email'],$valeurAttendu['pseudo'],$valeurAttendu['mot_de_passe']]);
    OK();

    //--Test--
    print("Lecture avec une query DAO : ");
    $table = $dao->query("SELECT email,pseudo,mot_de_passe FROM UTILISATEUR WHERE email =?", [$valeurAttendu['email']]);

    // Filtrer pour enlever les clés numériques
    $filteredTable = array_filter($table[0], function($key) {
        return !is_numeric($key);
    }, ARRAY_FILTER_USE_KEY);

    if ($filteredTable != $valeurAttendu) {
        var_dump("\n\nAttendue ", $valeurAttendu,"\n\nobtenue", $filteredTable);
        throw new Exception("Mauvaise lecture");
    };
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
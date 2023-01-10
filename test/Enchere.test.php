<?php
require_once(__DIR__ . '/../model/Article.class.php');
require_once(__DIR__ . '/../test/classeFormatage/helper.php');

$utilisateur = Utilisateur::read('a@gmail.com','a');
$article = new Article($utilisateur,"titreTestEnchere", "descriptionTest", "urlImageTest", 2, "artisteTest", "etatTest", "categorieTest", "tailleTest", "lieuTest", "styleTest");
try {
    $article->create();
    $enchere = $article->getEncheres()[0];


    //--Test--
    print("Création d'une enchère : ");
    $enchere->create();
    OK();

    // --Test--
    print("Lecture d'un enchère : ");
    $enchere2 = Enchere::read($enchere->getNumEnchere());
    if(!$enchere->egalEnchere($enchere2)) 
    {
        var_dump("\n\nValeurs attendues", $enchere,"\n\nValeurs avec read", $enchere2); 
        throw new Exception("pas la bonne enchere");
    };
    OK();


    // --Test--
    print("Update d'une Enchere : ");
    $enchere->setPrixActuel(1);
    $enchere->update();
    $enchere2 = Enchere::read($enchere->getNumEnchere());
    if(!$enchere->egalEnchere($enchere2)) 
    {
        var_dump("\n\nValeurs attendues", $enchere,"\n\nValeurs obtenues", $enchere2); 
        throw new Exception("pas update");
    };
    OK();

    // --Test--
    print("Suppression d'une enchère : ");
    $enchere->delete();
    OK();

} catch (Exception $e) {
    notOK();
    $dao = DAO::get();
    $dernierNum = $dao->query("SELECT max(num_enchere) FROM ENCHERE;",array())[0]['max(num_enchere)']; // Récupérer le dernier id crée
    $dao->query("DELETE FROM ENCHERE WHERE num_enchere = ?;", [$dernierNum]);
    
    print('\nErreur ' . $e->getMessage() . "\n");
}
$article->delete();

?>
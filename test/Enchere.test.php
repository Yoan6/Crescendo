<?php
require_once(__DIR__ . '/../model/Article.class.php');
require_once(__DIR__ . '/../test/classeFormatage/helper.php');
$dao = DAO::get();

$utilisateur = Utilisateur::readNum(1);
$article = new Article($utilisateur,"titreTestEnchere", "descriptionTest", ["imgTest"], 2, "artisteTest", "etatTest", "categorieTest", "tailleTest", "lieuTest", "styleTest");
try {
    $article->create();
    $enchere = new Enchere([$article]);


    //------------------------------------------------------Test------------------------------------------------------
    print("Création d'une enchère : ");
    $enchere->create();
    OK();

    //------------------------------------------------------Test------------------------------------------------------
    print("Lecture d'un enchère : ");
    $enchere2 = Enchere::read($enchere->getNumEnchere());
    if(!$enchere->egalEnchere($enchere2)) 
    {
        var_dump("\n\nValeurs attendues", $enchere,"\n\nValeurs avec read", $enchere2); 
        throw new Exception("pas la bonne enchere");
    };
    OK();


    //------------------------------------------------------Test------------------------------------------------------
    print("Update d'une Enchere : ");
    $enchere->setDateDebut(new DateTime());
    $enchere->update();
    $enchere2 = Enchere::read($enchere->getNumEnchere());
    if(!$enchere->egalEnchere($enchere2)) 
    {
        var_dump("\n\nValeurs attendues", $enchere,"\n\nValeurs obtenues", $enchere2); 
        throw new Exception("pas update");
    };
    OK();

    /*
    //------------------------------------------------------Test------------------------------------------------------
    print("Recherche avec readLike ");
    $enchere2 = Enchere::readLike($enchere->getArticles()[0]->getTitre())[0];
    if(!$enchere->egalEnchere($enchere2)) 
    {
        var_dump("\n\nValeurs attendues", $enchere,"\n\nValeurs obtenues", $enchere2); 
        throw new Exception("pas update");
    };
    OK();
    */

    //------------------------------------------------------Test------------------------------------------------------
    print("Encherir et récupérer le dernier prix : ");
    $enchere->Encherir($utilisateur, 2000);
    $prix_offre_base = $dao->query("select prix_offre from ENCHERIT where num_enchere= ?;", [$enchere->getNumEnchere()])[0]['prix_offre'];
    $prix_offre = $enchere->obtenirPrixActuel();
    if ($prix_offre != $prix_offre_base) {
        var_dump("\n\nValeurs attendues", $prix_offre_base,"\n\nValeurs obtenues", $prix_offre); 
        throw new Exception("l'enchere n'a pas aboutit");
    }
    OK();
    




    //------------------------------------------------------Test------------------------------------------------------
    print("Suppression d'une enchère : ");
    $enchere->delete();
    OK();

} catch (Exception | Error  $e) {
    notOK();
    $dernierNum = $dao->query("SELECT max(num_enchere) FROM ENCHERE;",array())[0][0]; // Récupérer le dernier id crée
    $dao->exec("DELETE FROM ENCHERE WHERE num_enchere = ?;", [$dernierNum]);
    
    print('\nErreur ' . $e->getMessage() . "\n");
}
$article->delete();

?>
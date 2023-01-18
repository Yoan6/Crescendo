<?php
require_once(__DIR__ . '/../model/Article.class.php');
require_once(__DIR__ . '/../test/classeFormatage/helper.php');

$utilisateur = Utilisateur::readNum(1);
$article = new Article($utilisateur,"titreTest", "descriptionTest", ["imageTest"], 2, "artisteTest", "etatTest", "categorieTest", "tailleTest", "lieuTest", "styleTest", new DateTime());
try {
    //--Test--
    print("Création d'un Article : ");
    $article->create();
    OK();

    // --Test--
    print("Lecture d'un Article : ");
    $article2 = Article::read($article->getTitre(),$article->getDescription());
    if(!$article->egalArticle($article2)) 
    {
        var_dump("\n\nValeurs a1", $article,"\n\nValeurs a2 avec read", $article2); 
        throw new Exception("pas le bon Article");
    };
    OK();

    // --Test--
    print("Update d'un Article : ");
    $article->setArtiste("Hello");
    $article->update();
    $article2 = Article::read($article->getTitre(),$article->getDescription());
    if(!$article->egalArticle($article2)) 
    {
        var_dump("\n\nValeurs attendues", $article,"\n\nValeurs obtenues", $article2); 
        throw new Exception("pas le bon Article");
    };
    OK();


    // --Test--
    print("Suppression d'un Article : ");
    $article->delete();
    OK();
} catch (Exception |Error $e) {
    notOK();
    $dao = DAO::get();
    //($article);
    $dao->exec("DELETE FROM Article WHERE (titre,description_article) = (?,?);", [$article->getTitre(), $article->getDescription()]);
    exit('\nErreur ' . $e->getMessage() . "\n");
}
?>
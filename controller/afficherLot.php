<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


    include_once(__DIR__."/../framework/view.class.php");
    include_once(__DIR__."/../model/Utilisateur.class.php");
    include_once(__DIR__."/../model/Article.class.php");
    include_once(__DIR__."/../model/Enchere.class.php");

    $prix = $_POST['prix'] ?? 0; 

    /***************************************************************************
    **                         Données de l'enchère
    ***************************************************************************/
    $utilisateur = Utilisateur::readNum(1);
    $num_enchere = $_GET['numEnchere'] ?? 1;
    $enchere = Enchere::read($num_enchere);
if ($enchere->getEstLot()) {
    $dateFin = $enchere->getDateFin()->format('d-m-Y');

    /***************************************************************************
     **                         Données de l'article
     ***************************************************************************/

    // Note : getArticles renvoie une array d'article, cependant php n'a pas de type arrayObject donc il ne sait pas que c'est l'array contient des types articles 
    $articleArray = $enchere->getArticles(); // Recupère un type Array
    $listeNumArticles = array(); // Création d'un tableau de numéros d'articles
    for ($i = 0; $i < count($articleArray); $i++) {
        $lesArticlesTypeArticle[$i] = Article::getTypeArticleFromArray($articleArray, $i); // Conversion en type Article et récupération du numéro de l'article
        $listeNumArticles[$i] = $lesArticlesTypeArticle[$i]->getNumArticle();
    }

    $imgUrl = array(); //liste des images pour présenter le lot
    $nomEnchere = 'Lot de ';
    $description = '';
    $prixMin = 0;
    foreach ($lesArticlesTypeArticle as $article) {
        //Pour chaque article du lot, on récupère la première image (qui est obligatoire)
        $imgUrl = $article->getImagesURL()[0];
        $titre = $article->getTitre();
        $nomEnchere .= strtolower($titre) . ' ';
        $description .= 'Description pour ' . $titre . "\n" . $article->$article->getDescription() . "\n" . "\n";
        $prixMin = $prixMin + $article->getPrixMin();
    }

    $vendeur = $lesArticlesTypeArticle[0]->getVendeur(); //récupération du vendeur du lot
    $idVendeur = $vendeur->getNumUtilisateur(); //récupération de l'id du vendeur
    $pseudo = $vendeur->getPseudo(); //récupération du pseudo du vendeur
    $imageProfilVendeur = $vendeur->getImgProfil(); //récupération de l'image de profil du vendeur
    /***************************************************************************
     **                         Construction de la vue
     ***************************************************************************/
    $view = new View();

    // données de l'enchère
    $view->assign('prixMin', $prixMin); //prix actuel 
    $view->assign('dateFin', $dateFin); //date de fin de l'enchère
    $view->assign('imgUrl', $imgUrl); //array des images
    $view->assign('nomEnchere', $nomEnchere);
    $view->assign('description', $description);

    $view->assign('idVendeur', $idVendeur); //id du vendeur
    $view->assign('pseudo', $pseudo); //pseudo du vendeur
    $view->assign('imageProfilVendeur', $imageProfilVendeur); //image de profil du vendeur


    $view->assign('lesArticlesTypeArticle', $lesArticlesTypeArticle);

    $view->display("voirLot.php");


    /***************************************************************************
     **                         Gestion des erreurs
     ***************************************************************************/

    // modifs Pablo

    // test encherir



}

else {
    $view = new View();
    $view->include("accueil.ctrl.php");
}

?>
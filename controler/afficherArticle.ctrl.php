<?php
    include_once(__DIR__."/../framework/view.class.php");
    include_once(__DIR__."/../model/Utilisateur.class.php");
    include_once(__DIR__."/../model/Article.class.php");
    include_once(__DIR__."/../model/Enchere.class.php");



    /***************************************************************************
    **                         Données de l'enchère
    ***************************************************************************/
    $num_enchere = 0;
    $enchere = Enchere::read($num_enchere);
    $prixActuel = $enchere->obtenirPrixActuel();
    $dateFin = $enchere->getDateFin();

    /***************************************************************************
    **                         Données de l'article
    ***************************************************************************/
    
    // Note : getArticles renvoie une array d'article, cependant php n'a pas de type arrayObject donc il ne sait pas que c'est l'array contient des types articles 
    $articleArray = $enchere->getArticles(); // Recupère un type Array
    $article = Article::getTypeArticleFromArray($articleArray,0); // Conversion en type Article

    $imgUrl = $article->getImagesURL()[0];
    $nomEnchere = $article->getTitre();
    $pseudo = $article->getVendeur()->getPseudo();
    $description = $article->getDescription();

    /***************************************************************************
    **                         Construction de la vue
    ***************************************************************************/
    $view = new View();
    
    // données de l'enchère
    $view->assign('prixActuel', $prixActuel);
    $view->assign('dateFin', $dateFin);

    // données de l'article
    $view->assign('imgUrl', $imgUrl);
    $view->assign('nomEnchere', $nomEnchere);
    $view->assign('pseudo', $pseudo);
    $view->assign('description', $description);
    $view->display("z.test.afficherArticler.view.php")
?>
<?php
    include_once(__DIR__."/../framework/view.class.php");
    include_once(__DIR__."/../model/Utilisateur.class.php");
    include_once(__DIR__."/../model/Article.class.php");
    include_once(__DIR__."/../model/Enchere.class.php");

    $num_enchere = $_GET['idArticleAsupprimer'] ?? 0;

    $enchere = Enchere::read($num_enchere);
    $article = Article::getTypeArticleFromArray($enchere->getArticles(), 0);

    if(!isset($_SESSION)) { session_start(); } 

    // vérifie si l'utilisateur connecté est le vendeur de l'article
    if($article->getVendeur()->getNumUtilisateur() == $_SESSION['num_utilisateur']) { 
        // s'il s'agit d'un lot, supprime l'enchère
        if ($enchere->getEstLot()) {
            $enchere->delete();
        } 
        // sinon : c'est un article, on le supprime
        else {
            $article->delete();
        }

    $_GET["choixObligatoire"] = ["num_vendeur" => [$_SESSION['num_utilisateur']]];
    ($_GET);
        //$_GET[["choixObligatoire"] =>["num_vendeur"]] = $_SESSION['num_utilisateur'];
        include("rechercheChoix.ctrl.php");
    }
    // Sinon l'utilisateur ne devrait pas être là

    ?>
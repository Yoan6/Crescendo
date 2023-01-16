<?php
    include_once(__DIR__."/../framework/view.class.php");
    include_once(__DIR__."/../model/Utilisateur.class.php");
    include_once(__DIR__."/../model/Article.class.php");
    include_once(__DIR__."/../model/Enchere.class.php");

    $num_enchere = $_GET['idArticleAsupprimer'] ?? 0;

    $enchere = Enchere::read($num_enchere);
    $article = Article::getTypeArticleFromArray($enchere->getArticles(), 0);

    session_start();

    if($article->getVendeur()->getNumUtilisateur() == $_SESSION['num_utilisateur']) { 
        if ($enchere->getEstLot()) {
            $enchere->delete();
        } else {
            // C'est un article
            $article->delete();
        }

        $view = new View();
        $view->assign("choixObligatoire[num_vendeur][]", $_SESSION['num_utilisateur']);
        $view->display("monEspaceVendeur.view.php");
    }
    // Sinon l'utilisateur ne devrait pas être là

    ?>
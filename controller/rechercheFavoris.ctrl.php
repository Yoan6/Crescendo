<?php
    include_once(__DIR__."/../framework/view.class.php");
    include_once(__DIR__."/../model/Utilisateur.class.php");
    include_once(__DIR__."/../model/Article.class.php");
    include_once(__DIR__."/../model/Enchere.class.php");

    if(!isset($_SESSION)) { session_start(); } 
    /***************************************************************************
    **                         Données
    ***************************************************************************/
    // initialisation
    $encheres = array(); // S'il y'a une erreur
    $errors = array();
    $controllerName = basename(__FILE__);
    $pageMax = 0;

    // Gérer les pages
    $page = $_GET['page'] ?? 1;
    $pageSize = 5; //Nombre d'article
    $nbBoutonPage = 5;
    $pagePrec = ($page <= 1 ? 1 : $page - 1);
    $nbArticle = 0;
    
    // Récupérer les enchères
    try {
        $nbArticle = article::nombreArticlesFavoris(); // Une erreur est générée si 0 article trouvé
        $encheres = Enchere::readPageFavoris($page, $pageSize, $_SESSION['num_utilisateur']);
    } catch (exception | error $e) {
        $errors[] = $e->getMessage();
    }

    $pageMax = (int) (  $nbArticle / $pageSize) +1;  
    $pageSuiv = ($page >= $pageMax ? $pageMax : $page + 1);




    /***************************************************************************
    **                         Construction de la vue
    ***************************************************************************/

    $view = new view();
    $view->assign("controllerName",$controllerName);

    $view->assign("encheres",$encheres);
    
    $view->assign('nbArticle', $nbArticle);
    $view->assign('nbBoutonPage', $nbBoutonPage);
    $view->assign('pagePrec', $pagePrec);
    $view->assign('page', $page);
    $view->assign('pageSuiv', $pageSuiv);
    $view->assign('pageSize', $pageSize);
    $view->assign('pageMax', $pageMax);
    $view->display("rechercheFavoris.view.php");

?>
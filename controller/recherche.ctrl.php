<?php
    include_once(__DIR__."/../framework/view.class.php");
    include_once(__DIR__."/../model/Utilisateur.class.php");
    include_once(__DIR__."/../model/Article.class.php");
    include_once(__DIR__."/../model/Enchere.class.php");

    if (isset($_SESSION)) session_start();

    /***************************************************************************
    **                         Données
    ***************************************************************************/
    // Initialisation des variables
    $recherche = $_GET["recherche"] ?? ""; 
    $encheres = array(); // S'il y'a une erreur
    $errors = array();
    $controllerName = basename(__FILE__);
    $pageMax = 0;

    // Gérer les pages (pagination)
    $page = $_GET['page'] ?? 1;
    $pageSize = 5; //Nombre d'article
    $nbBoutonPage = 5; //Nombre de bouton de page
    $pagePrec = ($page <= 1 ? 1 : $page - 1); // Si page = 1, on ne peut pas aller en dessous de 1

    
    // Récupérer les enchères en fonction de la recherche
    try {
        $pageMax = ceil(article::nombreArticlesLike($recherche) / $pageSize); // Une erreur est générée si 0 article trouvé
        $encheres = Enchere::readPageLike($page, $pageSize, $recherche); 
    } catch (exception | error $e) { // Si aucune enchère n'est trouvée
        $errors[] = $e->getMessage();
    }



    $pageSuiv = ($page >= $pageMax ? $pageMax : $page + 1);




    /***************************************************************************
    **                         Construction de la vue
    ***************************************************************************/

    $view = new view();
    $view->assign("controllerName",$controllerName);

    $view->assign("encheres",$encheres);

    $view->assign('nbBoutonPage', $nbBoutonPage);
    $view->assign('pagePrec', $pagePrec);
    $view->assign('page', $page);
    $view->assign('pageSuiv', $pageSuiv);
    $view->assign('pageSize', $pageSize);
    $view->assign('pageMax', $pageMax);
    $view->assign("recherche",$recherche);
    $view->display("recherche.view.php");

?>
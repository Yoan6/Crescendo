<?php
    include_once(__DIR__."/../framework/view.class.php");
    include_once(__DIR__."/../model/Utilisateur.class.php");
    include_once(__DIR__."/../model/Article.class.php");
    include_once(__DIR__."/../model/Enchere.class.php");

    /***************************************************************************
    **                         Données
    ***************************************************************************/
    // initialisation
    $titreArtistePattern = $_GET["recherche"] ?? "old"; 
    $encheres = array(); // S'il y'a une erreur
    $errors = array();

    // Gérer les pages
    $page = $_GET['page'] ?? 1;
    $pageSize = 5; 
    $pageMax = article::nombreArticlesTotal() / $pageSize;
    $pagePrec = ($page == 1 ? 1 : $page - 1); 
    $pageSuiv = ($page == $pageMax ? $pageMax : $page + 1);

    // Récupérer les enchères
    try {
        $encheres = Enchere::readPageLike($page, $pageSize, $titreArtistePattern);
    } catch (exception | error $e) {
        $errors[] = $e->getMessage();
    }

    //var_dump($encheres);
    /***************************************************************************
    **                         Construction de la vue
    ***************************************************************************/

    $view = new view();
    $view->assign("encheres",$encheres);
    $view->assign("titreArtistePattern",$titreArtistePattern);
    $view->display("recherche.php");

?>
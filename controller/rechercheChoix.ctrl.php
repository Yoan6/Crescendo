<?php
// Partie principale
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclusion du modèle et du framework
include_once(__DIR__."/../framework/view.class.php");
include_once(__DIR__."/../model/Utilisateur.class.php");
include_once(__DIR__."/../model/Article.class.php");
include_once(__DIR__."/../model/Enchere.class.php");


/***************************************************************************
**                         Données
***************************************************************************/
// Autres données
$recherche = $_GET["recherche"] ?? "%"; 
$choix = $_POST['choix'] ?? "style";
$valeurChoix = $_POST['valeurChoix'] ?? "pop";
$controllerName = basename(__FILE__);

$encheres = array(); // S'il y'a une erreur
$errors = array();
$pageMax = 0;

// Gérer les pages
$page = $_GET['page'] ?? 1;
$pageSize = 5; //Nombre d'article
$nbBoutonPage = 5;
$pagePrec = ($page == 1 ? 1 : $page - 1); 
$pageSuiv = ($page == $pageMax ? $pageMax : $page + 1);

try {
    $pageMax = article::nombreArticlesParChoix($choix,$valeurChoix) / $pageSize;  // Une erreur est générée si 0 article trouvé
    $encheres = Enchere::readPageChoix($page, $pageSize, $choix, $valeurChoix);
} catch (exception | error $e) {
    $errors[] = $e->getMessage();
}



$view = new View();

if (empty($encheres)) {
    $errors[] = "Pas d'enchère trouvée";
}
// Sinon on affiche la page des enchères
$view->assign("controllerName",$controllerName);

$view->assign('recherche', $recherche);
$view->assign('nbBoutonPage', $nbBoutonPage);
$view->assign('pagePrec', $pagePrec);
$view->assign('page', $page);
$view->assign('pageSuiv', $pageSuiv);
$view->assign('pageSize', $pageSize);
$view->assign('pageMax', $pageMax);
$view->assign('choix', $choix);
$view->assign('valeurChoix', $valeurChoix);

$view->assign('encheres', $encheres);
$view->display("rechercheChoix.view.php");



?>
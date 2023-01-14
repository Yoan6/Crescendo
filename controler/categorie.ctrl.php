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

$encheres = array(); // S'il y'a une erreur
$errors = array();
$categorie = $_GET['categorie'] ??  "";

// Gérer les pages
$page = $_GET['page'] ?? 1;
$pageSize = 5; 
$pageMax = article::nombreArticlesTotal() / $pageSize;
$pagePrec = ($page == 1 ? 1 : $page - 1); 
$pageSuiv = ($page == $pageMax ? $pageMax : $page + 1);

// Autres données
$choix = "style";
$valeurChoix = "pop";

try {
    $encheres = Enchere::readPageChoix($page, $pageSize, $choix, $valeurChoix);
} catch (exception | error $e) {
    $errors[] = $e->getMessage();
}



$view = new View();

// Si aucune enchère n'est trouvée, on affiche une page d'erreur
if (empty($encheres)) {
    $view->display("categories.view.php");
} else {
    // Sinon on affiche la page des enchères
    $view->assign('pagePrec', $pagePrec);
    $view->assign('page', $page);
    $view->assign('pageSuiv', $pageSuiv);
    $view->assign('pageSize', $pageSize);
    $view->assign('nombrePages', $pageMax);
    $view->assign('categorie', $categorie);
    $view->assign('encheres', $encheres);
    $view->display("categories.view.php");
}

$view = new View();
$view->display("accueil.php");

?>
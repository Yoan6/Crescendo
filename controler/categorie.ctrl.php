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


//////////////////////////////////////////////////////////////////////////////
// Partie récupération des données
///////////////////////////////////////////////////////////////////////////////

$pageSize = 20;

$page = $_GET['page'] ?? 1;
$categorie = $GET['categorie'] ?? "AlaUne";
var_dump($categorie);
$encheres = Enchere::readPageCategorie($page, $pageSize, $categorie);
$pageMax = (Enchere::nombreArticles($categorie) / $pageSize) + 1;
// Calcul du No de la page précécent
if ($page > 1) {
    // il suffit de passer à la précédente
    $pagePrec = $page - 1;
} else {
    $pagePrec = 1;
}

// Si la page est indiquée, il suffit de passer à la suivante
if ($page < $pageMax) {
    $pageSuiv = $page + 1;
} else {
    $pageSuiv = $pageMax;
}


// Si aucune enchère n'est trouvée, on affiche une page d'erreur
if (empty($encheres)) {
    $view->display("catégories.php");

} else {
    // Sinon on affiche la page des enchères
    $view->assign('pagePrec', $pagePrec);
    $view->assign('page', $page);
    $view->assign('pageSuiv', $pageSuiv);
    $view->assign('pageSize', $pageSize);
    $view->assign('nombrePages', $pageMax);
    $view->assign('categorie', $categorie);
    $view->assign('encheres', $encheres);
    $view->display("catégories.php");

}




$view = new View();
$view->display("accueil.php");

?>
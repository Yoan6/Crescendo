<?php
// Partie principale

// Inclusion du modèle et du framework
include_once(__DIR__ . "/../framework/view.class.php");
include_once(__DIR__ . "/../model/Utilisateur.class.php");
include_once(__DIR__ . "/../model/Article.class.php");
include_once(__DIR__ . "/../model/Enchere.class.php");



///////////////////////////////////////////////////////////////////////////////
// Partie récupération des données
///////////////////////////////////////////////////////////////////////////////
$pageSize = 20;

$page = $_GET['page'] ?? 1;
$categorie = $_POST['categorie'] ?? "AlaUne";
$encheres = Enchere::readPageCategorie($page, $pageSize, $categorie);
$nombrePages = (Enchere::nombreArticles($categorie) / $pageSize) + 1;
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

$view = new View();
// Si aucune enchère n'est trouvée, on affiche une page d'erreur
if (empty($encheres)) {
    $view->display("aucunArticle.php");
    exit();
} else {
    // Sinon on affiche la page des enchères
    $view->assign('pagePrec', $pagePrec);
    $view->assign('page', $page);
    $view->assign('pageSuiv', $pageSuiv);
    $view->assign('pageSize', $pageSize);
    $view->assign('nombrePages', $nombrePages);
    $view->assign('categorie', $categorie);
    $view->assign('encheres', $encheres);
    $view->display($categories + ".php");
}
?>
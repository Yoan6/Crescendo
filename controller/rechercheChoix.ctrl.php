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

// Données pour la recherche
$recherche = htmlspecialchars($_GET["recherche"] ?? "");

$choixEtvaleurs = $_GET['choix'] ?? array(); 
$choixObligatoireEtValeurs = $_GET['choixObligatoire'] ?? array();
$orderByChoix =  $_GET['orderByChoix'] ?? "date_debut";
$orderBy =  $_GET['orderBy'] ?? "DESC";

// Pour relancer le controller
$controllerName = basename(__FILE__);

// Initialisation en cas d'erreur
$encheres = array(); 
$errors = array();
$pageMax = 1;

// Gérer les pages
$page = $_GET['page'] ?? 1;
$pageSize = 5; //Nombre d'article
$nbBoutonPage = 5;
$pagePrec = ($page <= 1 ? 1 : $page - 1); 
$pageSuiv = ($page >= $pageMax ? $pageMax : $page + 1);

// Autres
$num_vendeur = $choixObligatoireEtValeurs["num_vendeur"][0] ?? "";





try {
    $encheres = Enchere::readPagePlusieursChoix($page, $pageSize, $choixEtvaleurs,$choixObligatoireEtValeurs,$orderByChoix,$orderBy);
    $pageMax = (int) ( article::nombreArticlesPlusieursChoix($choixEtvaleurs,$choixObligatoireEtValeurs) / $pageSize);  // Une erreur est générée si aucun article n'est trouvé
} catch (exception | error $e) {
    $errors[] = $e->getMessage();
    var_dump($errors);
}

$pageSuiv = ($page >= $pageMax ? $pageMax : $page + 1);

$view = new View();
;

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
$view->assign('choix', $choixEtvaleurs);
$view->assign('choixObligatoire', $choixObligatoireEtValeurs);
$view->assign('valeurChoix', "");

$view->assign('encheres', $encheres);



var_dump($num_vendeur);
if ($num_vendeur != "") {
    // information du vendeur
    $vendeur = Utilisateur::readNum($num_vendeur);
    $view->assign("vendeur", $vendeur);

    $view->display("monEspaceVendeur.view.php");
} else {
    $view->display("rechercheChoix.view.php");
}


?>
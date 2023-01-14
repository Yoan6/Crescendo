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
//Get OrderBy
$orderBy = $_GET['orderBy'] ?? "triParDefaut";

$page = $_GET['page'] ?? 1;
$categorie = $GET['categorie'] ?? "vetements";
//si la liste des styles musicaux n'est pas vide, on récupère les valeurs de la liste 
if (!empty($_GET['styleMusical'])) {
    $styleMusical = $_GET['styleMusical'];
} else {
    $styleMusical = "";
}
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


//si la catégorie est vide ou ne correspond pas à nos catégories, on affiche les plus likés (A la une) sinon on affiche la catégorie demandée
if ($categorie != "vetements" || $categorie != "instruments" || $categorie != "accessoires" || $categorie != "lot") {
    $encheres = Enchere::readPage($page, $pageSize);
    $categorie = "A la une";    // sauvegarde le nom de la cateogrie dans une variable pour l'afficher dans la page en fonction de la catégorie

} else {
    // sauvegarde le nom de la cateogrie dans une variable pour l'afficher dans la page en fonction de la catégorie

    if ($categorie == "vetements") {
        $categorie = "Vêtements";
    } elseif ($categorie == "instruments") {
        $categorie = "Instruments";
    } elseif ($categorie == "accessoires") {
        $categorie = "Accessoires";
    } elseif ($categorie == "lot") {
        $categorie = "Lots";
    }

//si la variable tri n'est pas égale à nos parmètres de tris 
    if ($orderBy != "triParDefaut" || $orderBy != "triPrixCroissant" || $orderBy != "triPrixDecroissant" || $orderBy != "triDateFinCroissant" || $orderBy != "triDateFinDecroissant") {
        $encheres = Enchere::readPageCategorie($page, $pageSize, $categorie);
    } else {
        //si la variable tri est égale à nos parmètres de tris 
        if ($orderBy == "triParDefaut") {
            $encheres = Enchere::readPageCategorie($page, $pageSize, $categorie);
        } elseif ($orderBy == "triPrixCroissant") {
            $encheres = Enchere::readPageCategorieTriPrixCroissant($page, $pageSize, $categorie);
        } elseif ($orderBy == "triPrixDecroissant") {
            $encheres = Enchere::readPageCategorieTriPrixDecroissant($page, $pageSize, $categorie);
        } elseif ($orderBy == "triDateFinCroissant") {
            $encheres = Enchere::readPageCategorieTriDateFinCroissant($page, $pageSize, $categorie);
        } elseif ($orderBy == "triDateFinDecroissant") {
            $encheres = Enchere::readPageCategorieTriDateFinDecroissant($page, $pageSize, $categorie);
        }
    }
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
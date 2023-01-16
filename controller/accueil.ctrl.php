<?php
// 
// Inclusion du modèle et du framework
include_once(__DIR__."/../framework/view.class.php");
include_once(__DIR__."/../model/Utilisateur.class.php");
include_once(__DIR__."/../model/Article.class.php");
include_once(__DIR__."/../model/Enchere.class.php");

$page = 1;
$pageSize = 5;
$encheres = array();
try {
    $encheres = Enchere::readPage($page, $pageSize);
} catch (Exception | Error) {
    // Ne rien faire
}

////////////////////////////////////////////////////////////////////////////
// Construction de la vue
////////////////////////////////////////////////////////////////////////////
$view = new View();

// Charge la vue
$view->assign('encheres', $encheres);
$view->display("accueil.view.php");
?>

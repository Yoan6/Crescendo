<?php
// 
// Inclusion du framework
include_once(__DIR__."/../framework/view.class.php");
include_once(__DIR__."/../model/Utilisateur.class.php");

if(!isset($_SESSION)) { 
    session_start(); 
} 

if(isset($_SESSION['num_utilisateur'])) {
    
}
else {
    $view = new View();

    // Charge la vue
    $view->display("accueil.php");
}
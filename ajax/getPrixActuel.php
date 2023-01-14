<?php
    include_once(__DIR__."/../framework/view.class.php");
    include_once(__DIR__."/../model/Utilisateur.class.php");
    include_once(__DIR__."/../model/Article.class.php");
    include_once(__DIR__."/../model/Enchere.class.php");
    try {
        // Récupérer les données
        $numEnchere = $_GET['numEnchere'] ?? -1;
        $enchere = Enchere::read($numEnchere);
        $prixActuel = $enchere->obtenirPrixActuel();

        // Envoyer le prix
        echo $prixActuel;
    } catch (Exception| Error $e) {
        // Ne rien faire
        echo $e->getMessage();
    }
?>
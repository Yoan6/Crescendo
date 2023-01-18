<?php
    include_once(__DIR__."/../framework/view.class.php");
    include_once(__DIR__."/../model/Utilisateur.class.php");
    include_once(__DIR__."/../model/Article.class.php");
    include_once(__DIR__."/../model/Enchere.class.php");
    try {
        // Récupérer les données
        $numEnchere = $_GET['numEnchere'] ?? -1;
        $numUtilisateur = $_GET['numUtilisateur'] ?? -1;
        $estLike = $_GET['estLike'] ?? null;

        var_dump($numEnchere, $numUtilisateur, $estLike);

        $enchere = Enchere::read($numEnchere);

        $enchere->setLike($numUtilisateur,$estLike);
     
    } catch (Exception| Error $e) {
        // Ne rien faire
        echo $e->getMessage();
    }
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Crescendo</title>
    <link rel="stylesheet" type="text/css" href="../design/header.css">
    <link rel="stylesheet" type="text/css" href="../design/crescendo.css">
    <link rel="stylesheet" type="text/css" href="../design/article.css">
    <link rel="stylesheet" type="text/css" href="../design/categories.css">
    <link rel="stylesheet" type="text/css" href="../design/favorisEnchereGagnee.css">

</head>

<?php if(!isset($_SESSION)) { session_start(); }?>

<body class="dark-mode">
    <?php include(__DIR__ . '/header.php'); ?>

    <main>
        <div id="titreAlaUne">
            <p >Les enchères les plus populaires</h1>
        </div>
        <div id="principale">
            <div id="divdroite">

                <div class="affichageArticle">
                    <div id="topAffichageArticle">
                    </div>


                    <?php include(__DIR__ . '/article/article.view.php'); ?>


                        
                        <div id="rienAAfficher"><p >Aucun article à afficher :(</p></div>
                        



                    <?php include(__DIR__ . '/article/pages.view.php'); ?>
                   
                </div>
            </div>


        </div>
    </main>

    <?php include(__DIR__ . '/footer.php'); ?>
</body>
<script src="../js/crescendo.js"></script>
<script src="../js/header.js"></script>
<script src="../js/categories.js"></script>

</html>
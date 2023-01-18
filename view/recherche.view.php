<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Crescendo</title>
    <link rel="stylesheet" type="text/css" href="../design/header.css">
    <link rel="stylesheet" type="text/css" href="../design/crescendo.css">
    <link rel="stylesheet" type="text/css" href="../design/article.css">
    <link rel="stylesheet" type="text/css" href="../design/categories.css">

</head>

<body class="dark-mode">
    <?php include(__DIR__ . '/header.php'); ?>

    <main>
        <div>
            <p id="titre">Résultat pour <?=htmlspecialchars($recherche)?></h1>

        </div>
        <div id="principale">
            <?php include("article/fitreGauche.view.php")?>
            <div id="divdroite">

                <div class="affichageArticle">
                    <div id="topAffichageArticle">
                        <div id="contenuOrderBy">

                            <?php include(__DIR__ . '/article/filtre.view.php'); ?>





                        </div>
                    </div>


                    <?php include(__DIR__ . '/article/article.view.php'); ?>
                    <?php include(__DIR__ . '/article/pages.view.php'); ?>
                    <?php var_dump(" " . $nbBoutonPage, " page " . $page," pageSize " .  $pageSize," pagePrec " .  $pagePrec, " pageSuiv " .  $pageSuiv, " pageMax " . $pageMax);?>
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
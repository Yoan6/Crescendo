<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Crescendo</title>
    <link rel="stylesheet" type="text/css" href="../design/header.css">
    <link rel="stylesheet" type="text/css" href="../design/crescendo.css">
    <link rel="stylesheet" type="text/css" href="../design/accueil.css">
    <link rel="stylesheet" type="text/css" href="../design/article.css">
    <link rel="icon" href="../design/image/icone.png">
</head>

<body class="dark-mode">
    <?php include(__DIR__ . '/header.php'); ?>

    <main id="accueil">
        <div id="banner">
            <img src="../design/image/accueil/concert.jpg">
            <div id="banner-text">
                <h3> Au plus proche de vos artistes préférés ! </h3>
                <a id="explore" href="../controller/rechercheALaUne.ctrl.php"> Explore dès maintenant !</a>
            </div>
        </div>

        <div class="conteneur" id="divVIA">
            <ul class="conteneur" id="via">
                <li>
                    <a href="../controller/rechercheChoix.ctrl.php?choixObligatoire[categorie][]=Vêtement">
                        <div>
                            <img src="../design/image/accueil/vete.jpeg">
                        </div>
                        <h2>Vêtements</h2>
                    </a>
                </li>
                <li>
                    <a href="../controller/rechercheChoix.ctrl.php?choixObligatoire[categorie][]=Instrument">
                        <div>
                            <img src="../design/image/accueil/instr.jpg">
                        </div>
                        <h2>Instruments</h2>
                    </a>
                </li>
                <li>
                    <a href="../controller/rechercheChoix.ctrl.php?choixObligatoire[categorie][]=Accessoire">
                        <div>
                            <img src="../design/image/accueil/acc.jpg">
                        </div>
                        <h2>Accessoires</h2>
                    </a>
                </li>
            </ul>


        </div>

        <div class="conteneur" id="articleSemaine">
            <div>
                <h1>Article du jour</h1>
                <?php include(__DIR__ . '/article/article.view.php'); ?>
            </div>
        </div>


    </main>



    <?php include(__DIR__ . '/footer.php'); ?>
</body>
<script src="../js/crescendo.js"></script>
<script src="../js/header.js"></script>
<script src="../js/article.js"></script>

</html>
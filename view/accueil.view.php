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

<?php if (!isset($_SESSION)) {
    session_start();
} ?>

<div class="popUpCookie">
    <form class="cookie" action="accueil.ctrl.php" method="POST">
        <h2>Cookies</h2>
        <p>Nous utilisons des cookies pour vous garantir la meilleure expérience sur notre site et pour que votre
            naviguation soit plus fluide. <br><br>
            Notes : nous ne récoltons vos données qu'à partir du moment où vous décidez de créer un compte. <br><br>
            Certains cookies sont obligatoire au bon fonctionnement du site, d'autres sont optionnels et nous permettent
            d'améliorer votre expérience utilisateur. <br><br></p>
        <div class="centre">
            <p class="pImportant"> Cookies obligatoires : </p>
            <ul>
                <li><label class="switchConsentement oblige">
                        <input type="checkbox" id="darkModeBouton">
                        <span class="slider round"></span>
                    </label>Dates de consentement des cookies (durée : 12 ans)</li>
                <li><label class="switchConsentement oblige">
                        <input type="checkbox" id="darkModeBouton">
                        <span class="slider round"></span>
                    </label>Adhésion aux cookies (durée : 2 ans)</li>
                <li><label class="switchConsentement oblige">
                        <input type="checkbox" id="darkModeBouton">
                        <span class="slider round"></span>
                    </label>Pseudo (durée : 2 ans)</li>
                <li><label class="switchConsentement oblige">
                        <input type="checkbox" id="darkModeBouton">
                        <span class="slider round"></span>
                    </label>Adresse mail (durée : 2 ans)</li>
                <li><label class="switchConsentement oblige">
                        <input type="checkbox" id="darkModeBouton">
                        <span class="slider round"></span>
                    </label>Numéro d'utilisateur (durée : 2 ans)</li>
                <li><label class="switchConsentement oblige">
                        <input type="checkbox" id="darkModeBouton">
                        <span class="slider round"></span>
                    </label>Mot de passe (durée : 2 ans)</li>
            </ul>

            <p class="pImportant">Cookies optionnels : </p>
            <div id="cookie-optionnel">
                <div class="optionnel">
                    <label for="cookie1" class="switchConsentement">
                        <input type="checkbox" id="cookie1">
                        <span class="slider round"></span>
                    </label>
                     <p >Prénom (durée : 2 ans)</p>
                </div>
                <div class="optionnel">
                    <label for="cookie2" class="switchConsentement">
                        <input type="checkbox" id="cookie2">
                        <span class="slider round"></span>
                    </label>
                     <p >Nom (durée : 2 ans)</p>
                </div>
                <div class="optionnel">
                    <label for="cookie3" class="switchConsentement">
                        <input type="checkbox" id="cookie3">
                        <span class="slider round"></span>
                    </label>
                     <p >Adresse de livraison (durée : 2
                        ans)</p>
                </div>
                <div class="optionnel">
                    <label for="cookie4"class="switchConsentement">
                        <input type="checkbox" id="cookie4">
                        <span class="slider round"></span>
                    </label>
                   <p >Age (durée : 2 ans)</p>
                </div>
            </div>

        </div>
        <p>En poursuivant votre navigation sur ce site, vous acceptez l’utilisation de cookies et le respect des <a
                class="condition" href="../view/conditionsUtilisation.view.php">Conditions Générales d'Utilisation</a>
        </p>

        <div class="bouttons">
            <button id="savoirPlus" type="submit">En savoir plus</button>
            <button id="accepter" type="submit">Accepter et continuer</button>
        </div>
    </form>
</div>

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
                <h1>Articles du jour</h1>
                <?php include(__DIR__ . '/article/article.view.php'); ?>
            </div>
        </div>


    </main>



    <?php include(__DIR__ . '/footer.php'); ?>
</body>
<script src="../js/accueil.js"></script>

<script src="../js/crescendo.js"></script>
<script src="../js/header.js"></script>
<script src="../js/article.js"></script>

</html>
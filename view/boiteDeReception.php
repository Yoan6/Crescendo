<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Crescendo</title>
    <link rel="stylesheet" type="text/css" href="../design/header.css">
    <link rel="stylesheet" type="text/css" href="../design/boiteDeReception.css">
    <link rel="stylesheet" type="text/css" href="../design/crescendo.css">
</head>

<body class="dark-mode">
    <?php include(__DIR__ . '/header.php'); ?>

    <main>
        <div>
            <h1 id="titre"> Boite de réception </h2>
        </div>

        <div id="encheres">

            <h2 class="sous-titre"> Enchères </h2>

            <div class="enchere">
                <div class="texte">
                    <p> Vous n'êtes plus le leader de l'enchère ! </p>
                    <p><b> Article : </b> Perruque d'Elton Johnn </p>
                    <p><b> Nouvelle enchère : </b> 10900 (+350€) </p>
                </div>
                <button class="btnVoirE"> Voir </button>
            </div>
            <div class="enchere">
                <div class="texte">
                    <p> Vous n'êtes plus le leader de l'enchère ! </p>
                    <p><b> Article : </b> Cache-oeil Madonna </p>
                    <p><b> Nouvelle enchère : </b> 5200 (+100€) </p>
                </div>
                <button class="btnVoirE"> Voir </button>
            </div>

            <h3 class="autres"> Voir les autres enchères (3) </h3>
        </div>

        <div id="notifications">

            <h2 class="sous-titre">Notifications</h2>

            <div class="notification">
                <div class="texte">
                    <p><b> Adam Khalid </b> vous a laissé une évaluation </p>
                </div>
                <button class="btnVoirN"> Voir </button>
            </div>
            <div class="notification">
                <div class="texte">
                    <p> Votre commande a été envoyée </p>
                </div>
                <button class="btnVoirN"> Voir </button>
            </div>
            <div class="notification">
                <div class="texte">
                    <p><b> Julien Law </b> a ajouté des nouveaux articles </p>
                </div>
                <button class="btnVoirN"> Voir </button>
            </div>
            <div class="notification">
                <div class="texte">
                    <p> Votre article favori <b> Lunettes Damso </b> a été vendu </p>
                </div>
                <button class="btnVoirN"> Voir </button>
            </div>

            <h3 class="autres"> Voir les autres notifications (7) </h3>
        </div>

    </main>

    
    
    <?php include(__DIR__ . '/footer.php'); ?>
</body>
<script src="../js/crescendo.js"></script>
<script src="../js/header.js"></script>
<script src="../js/categories.js"></script>

</html>
<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Crescendo</title>
        <link rel="stylesheet" type="text/css" href="../design/header.css">
		<link rel="stylesheet" type="text/css" href="../design/crescendo.css">
        <link rel="stylesheet" type="text/css" href="../design/accueil.css">
	</head>
	<body class="dark-mode">
        <?php include(__DIR__.'/header.php'); ?>
		
		<main id="accueil">
            <div id="banner">
                <img  src="../design/image/accueil/coeur_concert.jpeg">
            </div>
            <div class="conteneur" id="divVIA">
                <ul class="conteneur" id="via">
                    <li>
                        <a>
                            <img src="../design/image/accueil/vetement.jpg">
                            <h2>Vêtements</h2>
                        </a>
                    </li>
                    <li>
                        <a>
                            <img src="../design/image/accueil/vetement.jpg">
                            <h2>Instruments</h2>
                        </a>
                    </li>
                    <li>
                        <a>
                            <img src="../design/image/accueil/vetement.jpg">
                            <h2>Autres</h2>
                        </a>
                    </li>
                </ul>
</div>


		</main>
		
		
		
        <?php include(__DIR__.'/footer.php'); ?>	
	</body>
	<script src="../js/crescendo.js"></script>
    <script src="../js/header.js"></script>

</html>
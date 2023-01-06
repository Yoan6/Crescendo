<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Crescendo</title>
        <link rel="stylesheet" type="text/css" href="../design/header.css">
		<link rel="stylesheet" type="text/css" href="../design/crescendo.css">
        <link rel="stylesheet" type="text/css" href="../design/accueil.css">
        <link rel="stylesheet" type="text/css" href="../design/article.css">

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
                            <div>
                                <img src="../design/image/accueil/vetement.jpg">
                            </div>
                            <h2>Vêtements</h2>
                        </a>
                    </li>
                    <li>
                        <a>
                            <div>
                                <img src="../design/image/accueil/guitar.png">
                            </div>
                            <h2>Instruments</h2>
                        </a>
                    </li>
                    <li>
                        <a>
                            <div>
                                <img src="../design/image/accueil/autre.png">
                            </div>                            
                            <h2>Autres</h2>
                        </a>
                    </li>
                </ul>

                
            </div>
            
            <div class="conteneur" id="articleSemaine">
                <div>
                    <h1>Les articles de la semaine</h1>
                    
                    <div class="article">
                    
                        <div id="heart">
                            <img src="../design/image/heart.svg">
                        </div>
                        <div id="responsive">
                            <div id="photo">
                                <img src="../design/image/articles/veste-elton-john.png">
                            </div>
                            <div id="center">
                                <div>
                                    <h3>Veste d'Elton John</h3>
                                    <h3>10 000 $</h3>
                                </div>
                                <section>
                                    <p>Concert à New York d’Elton John, le 22 février 2022. Veste queue de pie à imprimé floral, sur la blablablabaalblabalbalablalbalbalbbalbalabablalblbaablabablablblbablalabblabalalbababll </p>
                                </section>
                                <a href="">Voir l'enchère</a>
                            </div>
                        </div>
                        
                        <div id="likes">
                            <img src="../design/image/icon/thumb up white.png">
                            <p>654</p>
                            <img src="../design/image/icon/thumb down white.png">
                        </div>

                    </div>

                </div>
            </div>
                

		</main>
		
		
		
        <?php include(__DIR__.'/footer.php'); ?>	
	</body>
	<script src="../js/crescendo.js"></script>
    <script src="../js/header.js"></script>

</html>
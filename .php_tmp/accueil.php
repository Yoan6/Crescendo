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
                <img  src="../design/image/accueil/concert.jpg">
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
                    <?php for ($i = 0; $i < 3; $i++){ ?>
                    <div class="article">
                    
                        <div id="divHeart">
                                <svg id="heart"viewBox="-0.5 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_iconCarrier"> <path d="M19.6706 5.4736C17.6806 3.8336 14.7206 4.1236 12.8906 5.9536L12.0006 6.8436L11.1106 5.9536C9.29063 4.1336 6.32064 3.8336 4.33064 5.4736C2.05064 7.3536 1.93063 10.7436 3.97063 12.7836L11.6406 20.4536C11.8406 20.6536 12.1506 20.6536 12.3506 20.4536L20.0206 12.7836C22.0706 10.7436 21.9506 7.3636 19.6706 5.4736Z" stroke="#ffffff" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
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
                                    <p>Concert à New York d’Elton John, le 22 février 2022. Veste queue de pie à imprimé floral, sur la blablablabaalblabalbalablalbalbalbbalbalabablalblbaabla
                                        bablablblbablalabblabalalbababll ddfazdfd dfzd zd dfzfzdfzf zf dzfz fzdfdzf zxxg fzfg zfgzgzfgz  ddfs fgdfg ehfherhyjj yj tyjtjer zr erzae ae er erea ssd sdd dfsdfsdf dsgsdgsdg sgsg sdg dsghhergegfd
                                     d s dsds rd zdz dzf fz  erfrgefgdge ergrg re ger erhergregzrg zr zh zrh zrzrrzrzrzr z zrrz rz r</p>
                                </section>
                                <a href="produit.php">Voir l'enchère</a>
                            </div>
                        </div>
                        
                        <div id="divLikes">
                            
                            <svg id="like" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_iconCarrier"> <title>i</title> <g id="Complete"> <g id="thumbs-up"> <path d="M7.3,11.4,10.1,3a.6.6,0,0,1,.8-.3l1,.5a2.6,2.6,0,0,1,1.4,2.3V9.4h6.4a2,2,0,0,1,1.9,2.5l-2,8a2,2,0,0,1-1.9,1.5H4.3a2,2,0,0,1-2-2v-6a2,2,0,0,1,2-2h3v10" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path> </g> </g> </g></svg>                            
                            
                            <p>654</p>
                            
                            <svg id="dislike" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#ffffff" transform="rotate(180)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_iconCarrier"> <title>i</title> <g id="Complete"> <g id="thumbs-up"> <path d="M7.3,11.4,10.1,3a.6.6,0,0,1,.8-.3l1,.5a2.6,2.6,0,0,1,1.4,2.3V9.4h6.4a2,2,0,0,1,1.9,2.5l-2,8a2,2,0,0,1-1.9,1.5H4.3a2,2,0,0,1-2-2v-6a2,2,0,0,1,2-2h3v10" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path> </g> </g> </g></svg>
                        </div>

                    </div>
                    <?php } ?>
                </div>
            </div>
                

		</main>
		
		
		
        <?php include(__DIR__.'/footer.php'); ?>	
	</body>
	<script src="../js/crescendo.js"></script>
    <script src="../js/header.js"></script>

</html>
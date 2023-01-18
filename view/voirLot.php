<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Crescendo</title>
    <link rel="stylesheet" type="text/css" href="../design/header.css">
    <link rel="stylesheet" type="text/css" href="../design/crescendo.css">
    <link rel="stylesheet" href="../design/article.css">

    <link rel="stylesheet" href="../design/voirLot.css">
</head>

<body class="dark-mode">
    <?php include(__DIR__ . '/header.php'); ?>

    <main>



        <div id="firstContent">

            <div>

                <h3 id="dateFinEnchère">
                    L'enchère se termine le <?php echo $dateFin; ?>
                </h3>


                <div id="topForm">
                    <div id="divTopLeft">
                        <div id="carousel">
                        <img src="" id="preview">
                            <?php foreach ($imgUrl as $img) { ?>
                                <img src="<?= $img ?>" class="carouselImg">
                            <?php } ?>
                            <svg id="buttonPrev" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve"
                                fill="#ffffff">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <style type="text/css">
                                        .st0 {
                                            fill: #000000;
                                        }
                                    </style>
                                    <g>
                                        <path class="st0"
                                            d="M255.991,0C114.615,0,0,114.615,0,256.009C0,397.385,114.615,512,255.991,512 C397.385,512,512,397.385,512,256.009C512,114.615,397.385,0,255.991,0z M345.464,323.884l-89.473-89.456l-89.456,89.456 l-44.097-44.097l133.552-133.57l133.57,133.57L345.464,323.884z">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                            <svg id="buttonNext" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve"
                                fill="#ffffff">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <style type="text/css">
                                        .st0 {
                                            fill: #000000;
                                        }
                                    </style>
                                    <g>
                                        <path class="st0"
                                            d="M255.991,0C114.615,0,0,114.615,0,256.009C0,397.385,114.615,512,255.991,512 C397.385,512,512,397.385,512,256.009C512,114.615,397.385,0,255.991,0z M345.464,323.884l-89.473-89.456l-89.456,89.456 l-44.097-44.097l133.552-133.57l133.57,133.57L345.464,323.884z">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                        </div>

                    </div>

                    <div id="divTopRight">
                        <h4>
                            <?= $nomEnchere ?>
                        </h4>
                        <div id="divPrixActuel">
                            <h3>Prix actuel</h3>
                            <h4><?= $prixMin ?></h4>
                        </div>

                        <div id="divNouveauPrix">
                            <input type="number" name="" id="prix" min="0" placeholder="Votre nouveau prix">
                            <button>
                                <p>Valider</p>
                                <img src="../design/image/paypal/PayPal_Logo_Icon_2014.svg" alt="LogoPaypal">
                            </button>
                        </div>
                    </div>
                </div>


                <div id="features">
                    <div id="featuresLeft">
                        <svg id="heart" viewBox="-0.5 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"
                            stroke="#ffffff">
                            <g id="SVGRepo_iconCarrier">
                                <path class="heartPath"
                                    d="M19.6706 5.4736C17.6806 3.8336 14.7206 4.1236 12.8906 5.9536L12.0006 6.8436L11.1106 5.9536C9.29063 4.1336 6.32064 3.8336 4.33064 5.4736C2.05064 7.3536 1.93063 10.7436 3.97063 12.7836L11.6406 20.4536C11.8406 20.6536 12.1506 20.6536 12.3506 20.4536L20.0206 12.7836C22.0706 10.7436 21.9506 7.3636 19.6706 5.4736Z"
                                    stroke="#ffffff" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round">
                                </path>
                            </g>
                        </svg>



                        <div>
                            <svg id="like" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#ffffff">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <title>i</title>
                                    <g id="Complete">
                                        <g id="thumbs-up">
                                            <path class="likePath"
                                                d="M7.3,11.4,10.1,3a.6.6,0,0,1,.8-.3l1,.5a2.6,2.6,0,0,1,1.4,2.3V9.4h6.4a2,2,0,0,1,1.9,2.5l-2,8a2,2,0,0,1-1.9,1.5H4.3a2,2,0,0,1-2-2v-6a2,2,0,0,1,2-2h3v10"
                                                fill="none" stroke="#ffffff" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"></path>
                                        </g>
                                    </g>
                                </g>
                            </svg>


                            <p>654</p>

                            <svg id="dislike" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#ffffff"
                                transform="rotate(180)">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <title>i</title>
                                    <g id="Complete">
                                        <g id="thumbs-up">
                                            <path class="dislikePath"
                                                d="M7.3,11.4,10.1,3a.6.6,0,0,1,.8-.3l1,.5a2.6,2.6,0,0,1,1.4,2.3V9.4h6.4a2,2,0,0,1,1.9,2.5l-2,8a2,2,0,0,1-1.9,1.5H4.3a2,2,0,0,1-2-2v-6a2,2,0,0,1,2-2h3v10"
                                                fill="none" stroke="#ffffff" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"></path>
                                        </g>
                                    </g>
                                </g>
                            </svg>

                        </div>

                    </div>

                    <a id="featuresRight" href="vendeur">
                        <div>
                            <img src="<?= $imageProfilVendeur ?>" alt="user">
                        </div>
                        <p>
                            <?= $pseudo ?>
                        </p>
                    </a>
                </div>


                <div id="middleForm">
                    <h3>
                        Description
                    </h3>

                    <p>
                        <?= $description ?>
                    </p>
                </div>
            </div>
        </div>

        <div id="bottomForm">
            <h2>
                Article du lot
            </h2>

            <?php // ($encheres)?>
            <?php if (isset($lesArticlesTypeArticle) && count($lesArticlesTypeArticle) >= 1): ?>
                <?php foreach ($lesArticlesTypeArticle as $article): ?>
                    <div class="article">

                        <div id="divHeart">
                            <svg id="heart" viewBox="-0.5 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"
                                stroke="#ffffff">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M19.6706 5.4736C17.6806 3.8336 14.7206 4.1236 12.8906 5.9536L12.0006 6.8436L11.1106 5.9536C9.29063 4.1336 6.32064 3.8336 4.33064 5.4736C2.05064 7.3536 1.93063 10.7436 3.97063 12.7836L11.6406 20.4536C11.8406 20.6536 12.1506 20.6536 12.3506 20.4536L20.0206 12.7836C22.0706 10.7436 21.9506 7.3636 19.6706 5.4736Z"
                                        stroke="#ffffff" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round">
                                    </path>
                                </g>
                            </svg>
                        </div>
                        <div id="responsive">
                            <div id="photo">
                                <img src="<?= $article->getImagesURL()[0] ?>">
                            </div>
                            <div id="center">
                                <div>
                                    <h3>
                                        <?= $article->getTitre() ?>
                                    </h3>
                                    <h3><?= $enchere->obtenirPrixActuel() ?>€</h3>
                                </div>
                                <section>
                                    <p>
                                        <?= $article->getDescription() ?>
                                    </p>
                                </section>
                                <form action="../controller/afficherArticle.ctrl.php" class="divBouton" method="get">
                                    <input class="numArticle" type="text" name="numEnchere"
                                        value="<?= $enchere->getNumEnchere() ?>">
                                    <button class="buttonModifier">Voir l'enchère</button>
                                </form>
                            </div>
                        </div>

                        <div id="divLikes">

                            <svg id="like" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#ffffff">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <title>i</title>
                                    <g id="Complete">
                                        <g id="thumbs-up">
                                            <path
                                                d="M7.3,11.4,10.1,3a.6.6,0,0,1,.8-.3l1,.5a2.6,2.6,0,0,1,1.4,2.3V9.4h6.4a2,2,0,0,1,1.9,2.5l-2,8a2,2,0,0,1-1.9,1.5H4.3a2,2,0,0,1-2-2v-6a2,2,0,0,1,2-2h3v10"
                                                fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"></path>
                                        </g>
                                    </g>
                                </g>
                            </svg>

                            <p>654</p>

                            <svg id="dislike" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#ffffff"
                                transform="rotate(180)">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <title>i</title>
                                    <g id="Complete">
                                        <g id="thumbs-up">
                                            <path
                                                d="M7.3,11.4,10.1,3a.6.6,0,0,1,.8-.3l1,.5a2.6,2.6,0,0,1,1.4,2.3V9.4h6.4a2,2,0,0,1,1.9,2.5l-2,8a2,2,0,0,1-1.9,1.5H4.3a2,2,0,0,1-2-2v-6a2,2,0,0,1,2-2h3v10"
                                                fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"></path>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>

                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>



    <?php include(__DIR__ . '/footer.php'); ?>
</body>
<script src="../js/crescendo.js"></script>
<script src="../js/header.js"></script>
<script src="../js/voirEnchère.js"></script>

</html>
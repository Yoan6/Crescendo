<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Crescendo</title>
    <link rel="stylesheet" type="text/css" href="../design/header.css">
    <link rel="stylesheet" type="text/css" href="../design/crescendo.css">
    <link rel="stylesheet" href="../design/voirEnchère.css">
</head>

<?php 
    $estMonProfil = false;
    $num_vendeur = $numVendeur;
    $num_utilisateur = $_SESSION['num_utilisateur'] ?? 0 ;
($num_utilisateur, $num_vendeur, strcmp($num_utilisateur, $num_vendeur));
    if(strcmp($num_utilisateur, $num_vendeur) == 0){
        $estMonProfil = true;
    }
?>

<?php ($estLot)?>

<body class="dark-mode">
    <?php include(__DIR__ . '/header.php'); ?>

    <main>



        <form id="formPrincipale" method="get" action="../controller/afficherArticle.ctrl.php">
        <input type="hidden" name="numEnchere" value="<?= $numEnchere ?>">

            <div>

                <h3 id="dateFinEnchère">
                    L'enchère se termine le <?= $dateFin ?>
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
                            <?= $titre ?>
                        </h4>
                        <div id="divPrixActuel">
                            <input type="hidden" id="numEnchere" value="<?= $numEnchere ?>">
                            <h3>Prix actuel</h3>
                            <h4><span id="prixActuelText"></span><span>€</span></h4>

                        </div>
                        
                        <?php if($num_utilisateur != null && !$estMonProfil) :?>
                        <div id="divNouveauPrix">
                            <form action="../controller/afficherArticle.ctrl.php" method="post">
                            <input id="inputPrix" type="number" name="prix" min="" placeholder="Votre nouveau prix">
                            <button name="encherir" value="encherir" type="submit" id="boutonValiderPrix">
                                <p>Valider</p>
                                <img src="../design/image/paypal/PayPal_Logo_Icon_2014.svg" alt="LogoPaypal">
                            </button>
                        </form>
                    </div>
                    <?php endif;?>
                    </div>
                </div>


                <div id="features">
                    <?php if(!$estMonProfil) :?>
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


                            <p onload="reactualiserLikeActuel(<?= $numEnchere ?>)">
                                <span id="likeActuelText"></span>
                            </p>

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
                        <?php if($estLot) :?>
                            <a href="afficherLot.php?numEnchere=<?=$numEnchere?>">
                                <p>Voir le lot associé</p> 
                                <svg height="200px" width="200px" version="1.1" id="_x32_"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    viewBox="0 0 512 512" xml:space="preserve" fill="#ffffff">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <style type="text/css">
                                            .st0 {
                                                fill: #ffffff;
                                            }
                                        </style>
                                        <g>
                                            <polygon class="st0"
                                                points="193.447,173.562 275.877,256 193.447,338.438 234.081,379.08 357.161,256 234.081,132.928 ">
                                            </polygon>
                                            <path class="st0"
                                                d="M255.992,0C114.606,0.015,0.015,114.606,0,256c0.015,141.394,114.606,255.984,255.992,256 C397.394,511.984,511.985,397.394,512,256C511.985,114.606,397.394,0.015,255.992,0z M408.585,408.585 c-39.118,39.079-92.938,63.189-152.593,63.205c-59.647-0.016-113.467-24.126-152.577-63.205 C64.328,369.474,40.218,315.647,40.21,256c0.008-59.655,24.118-113.475,63.205-152.585c39.11-39.087,92.93-63.197,152.577-63.205 c59.655,0.008,113.476,24.118,152.593,63.205c39.087,39.11,63.197,92.93,63.205,152.585 C471.782,315.647,447.672,369.474,408.585,408.585z">
                                            </path>
                                        </g>
                                    </g>
                                </svg>
                            </a>
                        <?php endif;?>
                    </div>
                    <?php endif;?>

                    <a id="featuresRight" href="../controller/rechercheChoix.ctrl.php?choixObligatoire[num_vendeur][]=<?=$numVendeur?>">
                        <div>
                            <img src="<?= $imgProfil ?>" alt="user">
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

                <div id="bottomForm">

                    <div id="divBottomLeft">
                        <h4>
                            Informations sur l'événement
                        </h4>
                        <div>

                            <section>
                                <h4>
                                    Artiste:
                                </h4>
                                <p>
                                    <?= $artiste ?>
                                </p>
                            </section>
                            <section>
                                <h4>
                                    Date du concert:
                                </h4>
                                <p>
                                    <?= $dateEvenement ?>
                                </p>
                            </section>
                            <section>
                                <h4>
                                    Lieu:
                                </h4>
                                <p>
                                    <?= $lieu ?>
                                </p>
                            </section>
                            <section>
                                <h4>
                                    Style musical:

                                </h4>
                                <p>
                                    <?= $style ?>
                                </p>
                            </section>



                        </div>
                    </div>


                    <div id="divBottomRight">
                        <h4>
                            Information sur l'article
                        </h4>
                        <div>
                            <section>
                                <h4>
                                    Taille:

                                </h4>
                                <p>
                                    <?= $taille ?>
                                </p>

                            </section>
                            <section>
                                <h4>
                                    Etat:

                                </h4>
                                <p>
                                    <?= $etat ?>
                                </p>

                            </section>
                            <section>
                                <h4>
                                    Catégorie:

                                </h4>
                                <p>
                                    <?= $categorie ?>
                                </p>

                            </section>

                        </div>
                    </div>
                </div>





            </div>

            </div>


        </form>




        <div class="popUpBackground">

            <form class="popUpForm" method="POST" action="../controller/afficherArticle.ctrl.php">
                <input id="reportNouveauPrix" type="hidden" name="newOrder" value="">

                <section>
                    <p>
                        Soumettre une nouvelle enchère
                    </p>

                </section>
                <div>

                    <div id="conteneurh3">
                        <h3>Votre nouveau prix : </h3>
                        <h3 id="prixEnchereProposee">5$</h3>
                    </div>

                    <div id="divCheckBoxConfirmation">
                        <input required type="checkbox" name="caseValidation" id="caseValidation">
                        <p>Je confirme vouloir enchérir à ce prix</p>
                    </div>

                    <div class="conteneurBouton">
                        <button id="annulerEnchere" type="button">
                            Annuler
                        </button>
                        <?php require_once('../api/paypalAPI/test/PaypalPaiement.class.php');
                        $paiementPaypal = new PaypalPaiement();
                        echo $paiementPaypal->ui($prixActuel);
                        ?>
                    </div>

                </div>

            </form>


        </div>









    </main>



    <?php include(__DIR__ . '/footer.php'); ?>
</body>
<script src="../js/crescendo.js"></script>
<script src="../js/header.js"></script>
<script src="../js/voirEnchère.js"></script>
<script src="../ajax/getPrixActuel.js" defer></script>
<script src="../ajax/like.js" defer></script>

</html>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Crescendo</title>
    <link rel="stylesheet" type="text/css" href="../design/header.css">
    <link rel="stylesheet" type="text/css" href="../design/crescendo.css">
    <link rel="stylesheet" type="text/css" href="../design/choisirArticlesLot.css">
    <link rel="stylesheet" type="text/css" href="../design/categories.css">

</head>

<body class="dark-mode">
    <?php include(__DIR__ . '/header.php'); ?>
    <?php if (isset($errors) && count($errors) > 0)
        include(__DIR__ . '/popup/erreur.view.php'); ?>

    <main>
        <div id="topPage">
            <div id="topPageLeft">

                <div id="userInformations">

                    <div id="conteneurImage">
                        <img src="../design/image/user/lisa.jpeg" alt="">
                    </div>

                    <div id="conteneurInformation">
                        <h2>
                            NomDuProfil
                        </h2>

                        <div>
                            <div id="conteneurEtoile">
                                <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" fill="#ffffff">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <rect x="0" fill="none" width="20" height="20"></rect>
                                        <g>
                                            <path
                                                d="M10 1L7 7l-6 .75 4.13 4.62L4 19l6-3 6 3-1.12-6.63L19 7.75 13 7zm0 2.24l2.34 4.69 4.65.58-3.18 3.56.87 5.15L10 14.88V3.24z">
                                            </path>
                                        </g>
                                    </g>
                                </svg>
                                <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" fill="#ffffff">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <rect x="0" fill="none" width="20" height="20"></rect>
                                        <g>
                                            <path
                                                d="M10 1L7 7l-6 .75 4.13 4.62L4 19l6-3 6 3-1.12-6.63L19 7.75 13 7zm0 2.24l2.34 4.69 4.65.58-3.18 3.56.87 5.15L10 14.88V3.24z">
                                            </path>
                                        </g>
                                    </g>
                                </svg>
                                <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" fill="#ffffff">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <rect x="0" fill="none" width="20" height="20"></rect>
                                        <g>
                                            <path
                                                d="M10 1L7 7l-6 .75 4.13 4.62L4 19l6-3 6 3-1.12-6.63L19 7.75 13 7zm0 2.24l2.34 4.69 4.65.58-3.18 3.56.87 5.15L10 14.88V3.24z">
                                            </path>
                                        </g>
                                    </g>
                                </svg>
                                <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" fill="#ffffff">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <rect x="0" fill="none" width="20" height="20"></rect>
                                        <g>
                                            <path
                                                d="M10 1L7 7l-6 .75 4.13 4.62L4 19l6-3 6 3-1.12-6.63L19 7.75 13 7zm0 2.24l2.34 4.69 4.65.58-3.18 3.56.87 5.15L10 14.88V3.24z">
                                            </path>
                                        </g>
                                    </g>
                                </svg>
                                <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" fill="#ffffff">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <rect x="0" fill="none" width="20" height="20"></rect>
                                        <g>
                                            <path
                                                d="M10 1L7 7l-6 .75 4.13 4.62L4 19l6-3 6 3-1.12-6.63L19 7.75 13 7zm0 2.24l2.34 4.69 4.65.58-3.18 3.56.87 5.15L10 14.88V3.24z">
                                            </path>
                                        </g>
                                    </g>
                                </svg>

                            </div>
                            <p>
                                13 évaluations
                            </p>
                        </div>

                    </div>
                </div>



                <div id="buttonUnderProfil">
                    <a id="modifierProfil">
                        Modifier le profil
                    </a>
                    <a id="voirLesAvis">
                        Voir les avis
                    </a>
                </div>


            </div>

            <div id="topPageRight">
                <a id="nouvelArticle">
                    Nouvel article
                </a>
            </div>

        </div>

        <form id="principale">
            <aside class="filtre">
                <div id="divValiderOuAnnuler">

                    <button id="valider">
                        Valider
                    </button>

                    <a href="../controller/" id="annuler">
                        Annuler
                    </a>

                </div>
            </aside>
            <div id="divdroite">

                <div class="affichageArticle">


                    <?php for ($i = 1; $i < 5; $i++) { ?>
                        <div class="article">

                            <div class="divCheckBox">
                                <input type="checkbox" class="inputCheckBox" name="articleSelectionne[]" value="<?= $i ?>">
                            </div>


                            <div id="responsive">
                                <div id="photo">
                                    <img src="../design/image/articles/veste-elton-john.png">
                                </div>
                                <div class="center">
                                    <div>
                                        <h3>Veste d'Elton John</h3>
                                        <h3>10 000 $</h3>
                                    </div>
                                    <section>
                                        <p>Concert à New York d’Elton John, le 22 février 2022. Veste queue de pie à
                                            imprimé
                                            floral, sur la
                                            blablablabaalblabalbalablalbalbalbbalbalabablalblbaablabablablblbablalabblabalalbababll
                                        </p>
                                    </section>


                                </div>
                            </div>



                        </div>

                    <?php } ?>



                </div>
            </div>


        </form>

        <form action="modifierArticle.ctrl.php" class="divPopUp">

            <div id="popUpSupprimerArticle">
                <input id="idArticleAsupprimer" name="idArticleAsupprimer" value="">

                <section>
                    <p>
                        Suprrimer définitivement l'article (nomDeLArticle) ?
                    </p>
                </section>
                <div>
                    <p>
                        Cette action est irréversible, toutes les informations sur l'article seront supprimées.
                    </p>
                    <div>
                        <button id="annulerSupprimer" type="button">
                            Annuler
                        </button>
                        <button id="confirmerSupprimer">
                            Supprimer
                        </button>
                    </div>

                </div>

            </div>

        </form>
    </main>

    <?php include(__DIR__ . '/footer.php'); ?>
</body>
<script src="../js/crescendo.js"></script>
<script src="../js/header.js"></script>
<script src="../js/choisirArticlesLot.js"></script>

</html>
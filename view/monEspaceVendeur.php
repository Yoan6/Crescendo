<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Crescendo</title>
    <link rel="stylesheet" type="text/css" href="../design/header.css">
    <link rel="stylesheet" type="text/css" href="../design/crescendo.css">
    <link rel="stylesheet" type="text/css" href="../design/articleDansEspaceVendeur.css">
    <link rel="stylesheet" type="text/css" href="../design/categories.css">
    <link rel="stylesheet" type="text/css" href="../design/monEspaceVendeur.css">
</head>

<?php if(!isset($_SESSION)) { session_start(); } ?>

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
                <a id="nouveauLot">
                    Nouveau lot
                </a>
            </div>

        </div>

        <div id="principale">
            <aside class="filtre">
                <div>
                    <div>
                        <button class="buttonDropFilter" tag="0">
                            <h3>Style musical </h3>
                            <svg class="plus" fill="#000000" viewBox="0 0 32 32" version="1.1"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <title>plus</title>
                                    <path
                                        d="M30 14.75h-12.75v-12.75c0-0.69-0.56-1.25-1.25-1.25s-1.25 0.56-1.25 1.25v0 12.75h-12.75c-0.69 0-1.25 0.56-1.25 1.25s0.56 1.25 1.25 1.25v0h12.75v12.75c0 0.69 0.56 1.25 1.25 1.25s1.25-0.56 1.25-1.25v0-12.75h12.75c0.69 0 1.25-0.56 1.25-1.25s-0.56-1.25-1.25-1.25v0z">
                                    </path>
                                </g>
                            </svg>
                            <svg class="minus" fill="#000000" viewBox="0 0 32 32" version="1.1"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <title>minus</title>
                                    <path
                                        d="M30 14.75h-28c-0.69 0-1.25 0.56-1.25 1.25s0.56 1.25 1.25 1.25v0h28c0.69 0 1.25-0.56 1.25-1.25s-0.56-1.25-1.25-1.25v0z">
                                    </path>
                                </g>
                            </svg>
                        </button>

                        <div class="filterdown">
                            <div>
                                <input type="checkbox" id="Regae" name="Regae">
                                <label for="Regae">Regae</label>
                            </div>
                            <div>
                                <input type="checkbox" id="Pop" name="Pop">
                                <label for="Pop">Pop</label>
                            </div>
                            <div>
                                <input type="checkbox" id="Rock" name="Rock">
                                <label for="Rock">Rock</label>
                            </div>
                            <div>
                                <input type="checkbox" id="Metal" name="Metal">
                                <label for="Metal">Metal</label>
                            </div>
                            <div>
                                <input type="checkbox" id="Rap" name="Rap">
                                <label for="Rap">Rap</label>
                            </div>
                            <div>
                                <input type="checkbox" id="Regae" name="Regae">
                                <label for="Regae">Regae</label>
                            </div>
                        </div>

                    </div>

                    <div>

                        <button class="buttonDropFilter" tag="1">
                            <h3>Type Objet</h3>
                            <svg class="plus" fill="#000000" viewBox="0 0 32 32" version="1.1"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <title>plus</title>
                                    <path
                                        d="M30 14.75h-12.75v-12.75c0-0.69-0.56-1.25-1.25-1.25s-1.25 0.56-1.25 1.25v0 12.75h-12.75c-0.69 0-1.25 0.56-1.25 1.25s0.56 1.25 1.25 1.25v0h12.75v12.75c0 0.69 0.56 1.25 1.25 1.25s1.25-0.56 1.25-1.25v0-12.75h12.75c0.69 0 1.25-0.56 1.25-1.25s-0.56-1.25-1.25-1.25v0z">
                                    </path>
                                </g>
                            </svg>
                            <svg class="minus" fill="#000000" viewBox="0 0 32 32" version="1.1"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <title>minus</title>
                                    <path
                                        d="M30 14.75h-28c-0.69 0-1.25 0.56-1.25 1.25s0.56 1.25 1.25 1.25v0h28c0.69 0 1.25-0.56 1.25-1.25s-0.56-1.25-1.25-1.25v0z">
                                    </path>
                                </g>
                            </svg>
                        </button>

                        <div class="filterdown">
                            <div>
                                <input type="checkbox" id="Regae" name="Regae">
                                <label for="Regae">Regae</label>
                            </div>
                            <div>
                                <input type="checkbox" id="Pop" name="Pop">
                                <label for="Pop">Pop</label>
                            </div>
                            <div>
                                <input type="checkbox" id="Rock" name="Rock">
                                <label for="Rock">Rock</label>
                            </div>
                            <div>
                                <input type="checkbox" id="Metal" name="Metal">
                                <label for="Metal">Metal</label>
                            </div>
                            <div>
                                <input type="checkbox" id="Rap" name="Rap">
                                <label for="Rap">Rap</label>
                            </div>
                            <div>
                                <input type="checkbox" id="Regae" name="Regae">
                                <label for="Regae">Regae</label>
                            </div>
                        </div>


                    </div>

                    <div>

                        <button class="buttonDropFilter" tag="2">
                            <h3>Style musical </h3>
                            <svg class="plus" fill="#000000" viewBox="0 0 32 32" version="1.1"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <title>plus</title>
                                    <path
                                        d="M30 14.75h-12.75v-12.75c0-0.69-0.56-1.25-1.25-1.25s-1.25 0.56-1.25 1.25v0 12.75h-12.75c-0.69 0-1.25 0.56-1.25 1.25s0.56 1.25 1.25 1.25v0h12.75v12.75c0 0.69 0.56 1.25 1.25 1.25s1.25-0.56 1.25-1.25v0-12.75h12.75c0.69 0 1.25-0.56 1.25-1.25s-0.56-1.25-1.25-1.25v0z">
                                    </path>
                                </g>
                            </svg>
                            <svg class="minus" fill="#000000" viewBox="0 0 32 32" version="1.1"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <title>minus</title>
                                    <path
                                        d="M30 14.75h-28c-0.69 0-1.25 0.56-1.25 1.25s0.56 1.25 1.25 1.25v0h28c0.69 0 1.25-0.56 1.25-1.25s-0.56-1.25-1.25-1.25v0z">
                                    </path>
                                </g>
                            </svg>
                        </button>

                        <div class="filterdown">
                            <div>
                                <input type="checkbox" id="Regae" name="Regae">
                                <label for="Regae">Regae</label>
                            </div>
                            <div>
                                <input type="checkbox" id="Pop" name="Pop">
                                <label for="Pop">Pop</label>
                            </div>
                            <div>
                                <input type="checkbox" id="Rock" name="Rock">
                                <label for="Rock">Rock</label>
                            </div>
                            <div>
                                <input type="checkbox" id="Metal" name="Metal">
                                <label for="Metal">Metal</label>
                            </div>
                            <div>
                                <input type="checkbox" id="Rap" name="Rap">
                                <label for="Rap">Rap</label>
                            </div>
                            <div>
                                <input type="checkbox" id="Regae" name="Regae">
                                <label for="Regae">Regae</label>
                            </div>
                        </div>


                    </div>
                </div>


                <div id="validerOuEffacer">
                    <button>
                        Valider
                    </button>
                    <button>
                        Tout effacer
                    </button>
                </div>
            </aside>
            <div id="divdroite">

                <div class="affichageArticle">
                    <div id="topAffichageArticle">
                        <div id="contenuOrderBy">

                            <select id="orderBy">
                                <option value="0">Trier par</option>
                                <option value="1">Plus aimés</option>
                                <option value="2">Moins aimés</option>
                            </select>





                        </div>
                    </div>

                    <?php for ($i = 0; $i < 5; $i++) { ?>
                        <div class="article">

                            
                        
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
                                    <form action="modifierArticle.ctrl.php" class="divBouton" >
                                    <input class="numArticle" type="text" name="idArticleAModifier" value="<?= $i ?>">
                                        <button class="buttonModifier">Modifier l'enchère</button>
                                    </form>
                                </div>
                            </div>

                            <div class="divSupprimer">

                                <svg viewBox="0 0 21 21" xmlns="http://www.w3.org/2000/svg" fill="#000000" stroke="#000000"
                                    stroke-width="1.1760000000000002">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <g fill="none" fill-rule="evenodd" stroke="#000000" stroke-linecap="round"
                                            stroke-linejoin="round" transform="translate(2 2)">
                                            <circle cx="8.5" cy="8.5" r="8"></circle>
                                            <g transform="matrix(0 1 -1 0 17 0)">
                                                <path d="m5.5 11.5 6-6"></path>
                                                <path d="m5.5 5.5 6 6"></path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>

                            </div>

                        </div>

                    <?php } ?>



                </div>
            </div>


        </div>

        <form action="modifierArticle.ctrl.php"class="divPopUp">

            <div id="popUpSupprimerArticle">
                <input  id="idArticleAsupprimer" name="idArticleAsupprimer" value="">

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
<script src="../js/categories.js"></script>
<script src="../js/monEspaceVendeur.js"></script>

</html>
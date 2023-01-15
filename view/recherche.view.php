<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Crescendo</title>
    <link rel="stylesheet" type="text/css" href="../design/header.css">
    <link rel="stylesheet" type="text/css" href="../design/crescendo.css">
    <link rel="stylesheet" type="text/css" href="../design/article.css">
    <link rel="stylesheet" type="text/css" href="../design/categories.css">

</head>

<body class="dark-mode">
    <?php include(__DIR__ . '/header.php'); ?>

    <main>
        <div>
            <p id="titre">Résultat pour <?=$recherche?></h1>

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
                                <?php include(__DIR__ . '/article/filtre.view.php'); ?>
                            </select>





                        </div>
                    </div>


                    <?php include(__DIR__ . '/article/article.view.php'); ?>
                    <?php include(__DIR__ . '/article/pages.view.php'); ?>

                </div>
            </div>


        </div>
    </main>

    <?php include(__DIR__ . '/footer.php'); ?>
</body>
<script src="../js/crescendo.js"></script>
<script src="../js/header.js"></script>
<script src="../js/categories.js"></script>

</html>
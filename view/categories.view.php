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
            <h1 id="titre"><?php $categorie ?></h1>

        </div>
        <div id="principale">
            <aside class="filtre">
                <div>
                    <div>
                        <button class="buttonDropFilter">
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
                                <input type="checkbox" id="blues" name="Blues">
                                <label for="Blues">Blues</label>
                            </div>
                            <div>
                                <input type="checkbox" id="classique" name="Classique">
                                <label for="Classique">Classique</label>
                            </div>
                            <div>
                                <input type="checkbox" id="disco" name="Disco">
                                <label for="Disco">Disco</label>
                            </div>
                            <div>
                                <input type="checkbox" id="electro" name="Electro">
                                <label for="Electro">Electro</label>
                            </div>
                            <div>
                                <input type="checkbox" id="funk" name="Funk">
                                <label for="Funk">Funk</label>
                            </div>
                            <div>
                                <input type="checkbox" id="hiphop" name="Hip-hop">
                                <label for="Hip-hop">Hip-hop</label>
                            </div>
                            <div>
                                <input type="checkbox" id="jazz" name="Jazz">
                                <label for="Jazz">Jazz</label>
                            </div>
                            <div>
                                <input type="checkbox" id="metal" name="Metal">
                                <label for="Metal">Metal</label>
                            </div>
                            <div>
                                <input type="checkbox" id="film" name="MusiqueDeFilm">
                                <label for="MusiqueDeFilm">Musique de film</label>
                            </div>
                            <div>
                                <input type="checkbox" id="pop" name="Pop">
                                <label for="Pop">Pop</label>
                            </div>
                            <div>
                                <input type="checkbox" id="reggae" name="Reggae">
                                <label for="Reggae">Reggae</label>
                            </div>
                            <div>
                                <input type="checkbox" id="rock" name="Rock">
                                <label for="Rock">Rock</label>
                            </div>
                            <div>
                                <input type="checkbox" id="techno" name="Techno">
                                <label for="Techno">Techno</label>
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

                            <select name="orderBy" id="orderBy">
                                <option value="0">Trier par</option>
                                <option value="1">Plus aimés</option>
                                <option value="2">Moins aimés</option>
                            </select>

                        </div>
                    </div>

                    
                    <?php include(__DIR__ . '/article/article.view.php'); ?>


                    <form id="pagination">
                        <!-- 
                        <input type=hidden class="pagePrec?" value="<?php echo $pagePrec; ?>">
                        <input type=hidden class="page?" value="<?php echo $page; ?>">
                        <input type=hidden class="pageSuiv" value="<?php echo  $pageSuiv; ?>">
                        <input type=hidden class="pageSize" value="<?php echo  $pageSize; ?>">
                        --> 


                    </form>

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
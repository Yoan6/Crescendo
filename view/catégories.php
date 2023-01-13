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

<?php   
    $view->assign('pagePrec',$pagePrec);
    $view->assign('page',$page);
    $view->assign('pageSuiv',$pageSuiv);
    $view->assign('pageSize', $pageSize);
    $view->assign('nombrePages',$nombrePages);
    $view->assign('encheres', $encheres);
    ?>
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

                            <select id="orderBy">
                                <option value="0">Trier par</option>
                                <option value="1">Plus aimés</option>
                                <option value="2">Moins aimés</option>
                            </select>





                        </div>
                    </div>


                    <?php foreach ($encheres as $enchere) { ?>
                        <?php if($enchere->getEstLot()){ ?>
                        <form class="article">

                            <div id="divHeart">
                                <svg class="heart" viewBox="-0.5 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    stroke="#ffffff">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path class="heartPath"
                                            d="M19.6706 5.4736C17.6806 3.8336 14.7206 4.1236 12.8906 5.9536L12.0006 6.8436L11.1106 5.9536C9.29063 4.1336 6.32064 3.8336 4.33064 5.4736C2.05064 7.3536 1.93063 10.7436 3.97063 12.7836L11.6406 20.4536C11.8406 20.6536 12.1506 20.6536 12.3506 20.4536L20.0206 12.7836C22.0706 10.7436 21.9506 7.3636 19.6706 5.4736Z"
                                            stroke="#ffffff" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </g>
                                </svg>
                            </div>
                            <div class="responsive">
                                <div id="photo">
                                    <img src="../design/image/articles/veste-elton-john.png">
                                </div>
                                <div id="center">
                                    <div>
                                        <h3><?php $enchere->getArticles[0]->getTitre()?></h3>
                                        <h3><?php $enchere->getArticles[0]->getPrixMin()?></h3>
                                    </div>
                                    <section>
                                        <p><?php $enchere->getArticles[0]->getDescription()?></p>
                                    </section>
                                    <a href="voirEnchère.php?<?php $enchere->getArticles[0]->getNumArticle() ?>">Voir l'enchère</a>
                                </div>
                            </div>

                            <div id="divLikes">
                                
                                <svg class="like" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#ffffff">
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

                                <p>543</p>

                                
                                <svg class="dislike" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#ffffff"
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
                            <!-- 
                            <input type=hidden class="disliked" value="<?php echo $disliked; ?>">
                            <input type=hidden class="isdisliked" value="<?php echo $isdisliked; ?>">
                            <input type=hidden class="numberOfLike" value="<?php echo $numberOfLike; ?>">
                            --> 
                        </form>
                        <?php } else { ?>
        
                            

                        <?php }?>
                    <?php } ?>



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
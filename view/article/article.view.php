<?php // ($encheres)?>
<?php if (isset($encheres) && count($encheres) >= 1): ?>
    <?php foreach ($encheres as $enchere):
        $article = Article::getTypeArticleFromArray($enchere->getArticles(), 0); ?>
        <div class="article">
            
            <div id="divHeart">
                <svg class="heartBouton" id="heart" viewBox="-0.5 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M19.6706 5.4736C17.6806 3.8336 14.7206 4.1236 12.8906 5.9536L12.0006 6.8436L11.1106 5.9536C9.29063 4.1336 6.32064 3.8336 4.33064 5.4736C2.05064 7.3536 1.93063 10.7436 3.97063 12.7836L11.6406 20.4536C11.8406 20.6536 12.1506 20.6536 12.3506 20.4536L20.0206 12.7836C22.0706 10.7436 21.9506 7.3636 19.6706 5.4736Z"
                            stroke="#ffffff" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
                </svg>
            </div>
            <div id="responsive">
                <div id="photo">
                    <img src="<?= $article->getImagesURL()[0] ?>">
                </div>
                <div id="center">
                    <div>
                        <h3><?= $article->getTitre() ?></h3>
                        <h3><?= $enchere->obtenirPrixActuel() ?>€</h3>
                    </div>
                    <section>
                        <p><?= $article->getDescription() ?></p>
                    </section>
                    <form action="../controller/afficherArticle.ctrl.php" class="divBouton" method="get">
                        <input class="numArticle" type="text" name="numEnchere" value="<?=$enchere->getNumEnchere()?>">
                        <button class="buttonModifier">Voir l'enchère</button>
                    </form>
                </div>
            </div>
            <input type="hidden" class="numEnchereRecupererValeur" value="<?= $enchere->getNumEnchere()?>">
        
            <div id="divLikes">
                <svg id="like" class="likeBouton" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#ffffff">
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

                <p><span class="likeActuelText"></span></p>

                <svg id="dislike" class="dislikeBouton" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#ffffff" transform="rotate(180)">
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
<input type="hidden" class="numUtilisateurRecupererValeur" value="<?= ($_SESSION['num_utilisateur'] ?? "")?>">
<script src="../ajax/like.js"></script>
<script src="../ajax/favoris.js"></script>
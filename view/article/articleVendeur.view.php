<?php if(isset($encheres) && count($encheres) >= 1):?>
<?php foreach($encheres as $enchere) : $article = Article::getTypeArticleFromArray($enchere->getArticles(),0);?> 
    <div class="article">

        
    
        <div id="responsive">
            <div id="photo">
                <img src="<?= $article->getImagesURL()[0] ?>">
            </div>
            <div class="center">
                <div>
                    <h3><?= $article->getTitre() ?></h3>
                    <h3><?= $enchere->obtenirPrixActuel() ?>€</h3>
                </div>
                <section>
                    <p><?= $article->getDescription() ?></p>
                </section>
                <form action="updateArticle.ctrl.php" class="divBouton" >
                <input class="numArticle" type="text" name="idArticleAModifier" value="<?=$enchere->getNumEnchere()?>">
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
    <?php endforeach;?>
<?php endif;?>
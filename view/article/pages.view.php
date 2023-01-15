<nav id="navPages">
    <!--Première page-->
    <a href="../controller/<?=$controllerName?>?page=<?=1?>&recherche=<?=$recherche?>"><<</a>
    <a href="../controller/<?=$controllerName?>?page=<?=$pagePrec?>&recherche=<?=$recherche?>"><</a>

    <!--Page actuelle-->
    <a selected href="../controller/<?=$controllerName?>?page=<?=$page?>&recherche=<?=$recherche?>"><?=$page?></a>
    <!--Génération des autres boutons pour nbBoutonPage-->
    <?php for($i = $page+1; $i < $page + $nbBoutonPage && $i<= $pageMax; $i++ ) : ?>
        <a href="../controller/<?=$controllerName?>?page=<?=$i?>&recherche=<?=$recherche?>"><?=$i?></a>
    <?php endFor; ?>

    <!--Prec-->
    <a href="../controller/<?=$controllerName?>?page=<?=$pageSuiv?>&recherche=<?=$recherche?>">></a>
    <!--Dernière-->
    <a href="../controller/<?=$controllerName?>?page=<?=$pageMax?>&recherche=<?=$recherche?>">>></a>
</nav>
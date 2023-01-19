<?php if(!isset($_SESSION)) { session_start(); } ?>

<?php 
    $num_utilisateur = $_SESSION['num_utilisateur'] ?? 0;
    $pseudo = Utilisateur::readNum($num_utilisateur)->getPseudo();
?>



<div id="userInformations">

    <div id="conteneurImage">
        <img src="<?=$utilisateur->getImageURL()?>" alt="">
    </div>

    <div id="conteneurInformation">
        <h2>
            <?=htmlspecialchars($pseudo)?>
        </h2>

        <div>
            <p>
                <?=$nbArticle?> articles
            </p>
        </div>

    </div>
</div>
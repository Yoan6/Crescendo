<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Crescendo</title>
    <link rel="stylesheet" type="text/css" href="../design/header.css">
    <link rel="stylesheet" type="text/css" href="../design/crescendo.css">
    <link rel="stylesheet" type="text/css" href="../design/article.css">
    <link rel="stylesheet" type="text/css" href="../design/articleDansEspaceVendeur.css">
    <link rel="stylesheet" type="text/css" href="../design/categories.css">
    <link rel="stylesheet" type="text/css" href="../design/monEspaceVendeur.css">
</head>

<?php session_start(); ?>
<?php if(!isset($_SESSION)) { session_start(); } ?>

<?php 
    $estMonProfil = false;
    $num_vendeur = $choixObligatoire["num_vendeur"][0];
    $num_utilisateur = strval($_SESSION['num_utilisateur']);
    if(strcmp($num_utilisateur, $num_vendeur) == 0){
        $estMonProfil = true;
    }
    $pseudo = $vendeur->getPseudo();
?>


<body class="dark-mode">
    <?php include(__DIR__ . '/header.php'); ?>
    <?php if (isset($errors) && count($errors) > 0)
        include(__DIR__ . '/popup/erreur.view.php'); ?>

    

    <main>
        <div id="topPage">
            <div id="topPageLeft">

                <div id="userInformations">

                    <div id="conteneurImage">
                        <img src="<?=$utilisateur->getImageURL()?>" alt="">
                    </div>

                    <div id="conteneurInformation">
                        <h2>
                            <?=$pseudo?>
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
                                <?=$pageMax?> articles en vente
                            </p>
                        </div>

                    </div>
                </div>


                <div id="buttonUnderProfil">
                    <?php if($estMonProfil) :?>
                        <a id="modifierProfil" href="parametre.ctrl.php">
                            Modifier le profil
                        </a>
                    <?php endif;?>
                    
                </div>


            </div>

            <div id="topPageRight">
                <?php if($estMonProfil) :?>
                    <a id="nouvelArticle" href="creerEnchere.ctrl.php">
                        Nouvel article
                    </a>
                    <a id="nouveauLot">
                        Nouveau lot
                    </a>
                <?php endif;?>
            </div>
        </div>

        <div id="principale">
            <?php include("article/fitreGauche.view.php")?>
            <div id="divdroite">

                <div class="affichageArticle">
                    <div id="topAffichageArticle">
                        <div id="contenuOrderBy">

                            <?php include(__DIR__ . '/article/filtre.view.php'); ?>

                        </div>
                    </div>
                    
                    <?php 
                    if($estMonProfil){
                        include(__DIR__ . '/article/articleVendeur.view.php');
                    } else {
                        include(__DIR__ . '/article/article.view.php');
                    }
                    include(__DIR__ . '/article/pages.view.php');
                    ?>


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
            


        

        <form action="deleteArticle.ctrl.php" class="divPopUp">

            <div id="popUpSupprimerArticle">
                <input  id="idArticleAsupprimer" name="idArticleAsupprimer" value="">

                <section>
                    <p>
                        Suprrimer définitivement l'article ?
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
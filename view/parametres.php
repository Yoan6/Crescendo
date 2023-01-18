<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Crescendo</title>
    <link rel="stylesheet" type="text/css" href="../design/header.css">
    <link rel="stylesheet" type="text/css" href="../design/crescendo.css">
    <link rel="stylesheet" type="text/css" href="../design/parametres.css">
</head>

<?php if(!isset($_SESSION)) { session_start(); } ?>

<body class="dark-mode">
    <?php include(__DIR__ . '/header.php'); ?>

    <main>
        <div>
            <h1>Mon profil</h1>

            <div id="divModifImage">
                <div id="divImage">
                    <div>
                        <img id="nouvelleImageTopLeft" src="<?= $imgProfil ?>" alt="image profil">
                        <img id="imageRetenue" src="">

                    </div>
                </div>

                <form action="../controller/parametre.ctrl.php" method="POST">
                    <button type="button" id="modifImageProfil">
                        Modifier l'image de profil
                    </button>

                    <button type="button" id="effacerImageProfil">
                        Effacer l'image
                    </button>
                </form>
            </div>

            <div class="modif">
                <h2>
                    Pseudo
                </h2>
                <div class="afficherAttribut">
                    <p>
                        <?= htmlspecialchars($pseudo) ?>
                    </p>
                    <button id="modifPseudo">
                        Modifier le pseudo
                    </button>
                </div>
                <form class="formModif" method="POST" action="../controller/parametre.ctrl.php">
                    <div class="champsAremplir">
                        <input type="text" name="pseudo" placeholder="Votre pseudo" required>

                    </div>
                    <div class="annulerOuValider">
                        <button class="annuler" type="button">
                            Annuler
                        </button>
                        <button class="valider" type="submit" name="confirmer" value="pseudo">
                            Valider
                        </button>
                    </div>
                </form>
            </div>

            <div>
                <?php

                if (isset($error) && count($error) != 0) {
                    foreach ($error as $e) { ?>
                        <p class="error">
                            <?php echo ($e); ?>
                        </p>
                        <?php
                    }
                }
                ?>

            </div>

            <div class="modif">
                <h2>
                    Addresse email
                </h2>
                <div class="afficherAttribut">
                    <p>
                        <?= htmlspecialchars($mail) ?>
                    </p>
                    <button id="modifMail">
                        Modifier l'adresse mail
                    </button>
                </div>
                <form class="formModif" method="POST" action="../controller/parametre.ctrl.php">
                    <div class="champsAremplir">
                        <input placeholder="Votre nouveau mail" type="email" name="mail" value="" required>
                        <input placeholder="Mot de passe" type="text" name="password" value="" minlength="12" required>

                    </div>


                    <div class="annulerOuValider">
                        <button class="annuler" type="button">
                            Annuler
                        </button>
                        <button class="valider" type="submit" name="confirmer" value="adresseMail">
                            Valider
                        </button>
                    </div>
                </form>
            </div>

            <div class="modif">
                <h2>
                    Adresse de livraison
                </h2>
                <div class="afficherAttribut">
                    <p>
                        <?= htmlspecialchars($adresse) ?>, <?= htmlspecialchars($postal) ?> <?= htmlspecialchars($ville) ?>
                    </p>
                    <button id="modifAdresse">
                        Modifier l'adresse de livraison
                </div>


                <form class="formModif" method="POST" action="../controller/parametre.ctrl.php">

                    <div class="champsAremplir">
                        <div id="postalEtVille">
                            <input placeholder="Code postal" type="text" name="postal" value="" required>
                            <input placeholder="Ville" type="text" name="ville" value="" required>
                        </div>

                        <input placeholder="Adresse" type="text" name="adresse" value="" required>
                    </div>



                    <div class="annulerOuValider">
                        <button class="annuler" type="button">
                            Annuler
                        </button>
                        <button class="valider" type="submit" name="confirmer" value="adresseLivraison">
                            Valider
                        </button>
                    </div>
                </form>
            </div>


            <div class="modif">
                <h2>
                    Mot de passe
                </h2>

                <div class="afficherAttribut">
                    <p>
                        **********
                    </p>
                    <button id="modifMdp">
                        Modifier le mot de passe
                    </button>
                </div>
                <form class="formModif" method="POST" action="../controller/parametre.ctrl.php">
                    <div class="champsAremplir">
                        <input placeholder="Ancien mot de passe" type="text" name="ancienPassword" value="" minlength="12" required>
                        <input placeholder="Nouveau mot de passe" type="text" name="nouveauPassword" value="" minlength="12" required>
                        <input placeholder="Confirmer le nouveau mot de passe" type="text" name="checkPassword" minlength="12" value="" required>

                    </div>


                    <div class="annulerOuValider">
                        <button class="annuler" type="button">
                            Annuler
                        </button>
                        <button class="valider" type="submit" name="confirmer" value="password">
                            Valider
                        </button>
                    </div>
                </form>



            </div>
            <div id="divSupprimerCompte">

                <button id="btnSupprimerCompte">
                    Supprimer le compte
                </button>
            </div>

        </div>


        <form class="divPopUp" method="POST" action="../controller/parametre.ctrl.php">
            <input type="hidden" name="supprimerCompte" value="idDuCompte">
            <div class="popUp">
                <section>
                    <p>
                        Supprimer définitivement votre compte ?
                    </p>
                </section>
                <div>
                    <p>
                        Cette action est irréversible, toutes les données relatives à votre profil seront effacées
                    </p>
                    <div class="conteneurBouton">
                        <button id="annulerSupprimer" type="button">
                            Annuler
                        </button>
                        <button id="confirmerSupprimer" type="submit" name="confirmer" value="effacer">
                            Supprimer
                        </button>
                    </div>

                </div>

            </div>

        </form>


        <form class="divPopUp" method="post" enctype="multipart/form-data" action="../controller/parametre.ctrl.php">

            <div class="popUp">
                <section>
                    <p>
                        Changement de photo de profil
                    </p>
                </section>
                <div id="conteneurLabelInputImage">
                    <input type="file" name="changementImage" value="true" id="nouvelImage" required=""
                        accept="image/png, image/jpeg, image/jpg">
                    <label id="labelNouvelImage">
                        <svg fill="#000000" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"
                            enable-background="new 0 0 512 512" xml:space="preserve">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <g>
                                    <polygon
                                        points="272,128 240,128 240,240 128,240 128,272 240,272 240,384 272,384 272,272 384,272 384,240 272,240 ">
                                    </polygon>
                                    <path
                                        d="M256,0C114.609,0,0,114.609,0,256s114.609,256,256,256s256-114.609,256-256S397.391,0,256,0z M256,472 c-119.297,0-216-96.703-216-216S136.703,40,256,40s216,96.703,216,216S375.297,472,256,472z">
                                    </path>
                                </g>
                            </g>
                        </svg>
                        <span>Ajouter une image</span>
                    </label>
                    <div id="carousel">
                        <img id="previsualisationImage" src="" alt="">
                    </div>

                </div>

                <div>
                    <div class="conteneurBouton">
                        <button id="annulerChangerImage" type="button">
                            Annuler
                        </button>
                        <button id="confirmerChangerImage" type="   ">
                            Valider
                        </button>
                    </div>
                </div>

            </div>

        </form>


        <form class="divPopUp" method="POST" action="../controller/parametre.ctrl.php">
            <input type="hidden" name="supprimerPhotoProfil" value="idDuCompte">
            <div class="popUp">
                <section>
                    <p>
                        Supprimer votre photo de profil ?
                    </p>
                </section>
                <div>
                    <div class="conteneurBoutonEffacerPhotoProfil">
                        <button id="annulerSupprimerPhoto" type="button">
                            Annuler
                        </button>
                        <button id="confirmerSupprimerPhoto" name="confirmer" value="effacerImg" type="submit">
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
<script src="../js/parametres.js"></script>

</html>
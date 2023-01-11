<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Crescendo</title>
    <link rel="stylesheet" type="text/css" href="../design/header.css">
    <link rel="stylesheet" type="text/css" href="../design/crescendo.css">
    <link rel="stylesheet" type="text/css" href="../design/parametres.css">
</head>

<body class="dark-mode">
    <?php include(__DIR__ . '/header.php'); ?>

    <main>
        <div>
            <h1>Mon profil</h1>

            <div id="divModifImage">
                <div id="divImage">
                    <div>
                        <img src="../design/image/user/lisa.jpeg" alt="">
                    </div>
                </div>

                <form>
                    <button id="modifImageProfil">
                        Modifier l'image de profil
                    </button>
                    <button id="effacerImageProfil">
                        Effacer l'image
                    </button>
                </form>
            </div>

            <div class="modif">
                <h2>
                    Pseudo
                </h2>
                <div class="afficherAttribut">
                    <p>monPseudo392</p>
                    <button id="modifPseudo">
                        Modifier le pseudo
                    </button>
                </div>
                <form class="formModif" method="post" action="">
                    <div class="champsAremplir">
                        <input type="text" name="pseudo" value="">

                    </div>
                    <div class="annulerOuValider">
                        <button class="annuler" type="button">
                            Annuler
                        </button>
                        <button class="valider">
                            Valider
                        </button>
                    </div>
                </form>
            </div>

            <div class="modif">
                <h2>
                    Addresse email
                </h2>
                <div class="afficherAttribut">
                    <p>monMail@gmail.com</p>
                    <button id="modifMail">
                        Modifier l'adresse mail
                    </button>
                </div>
                <form class="formModif" method="post" action="">
                    <div class="champsAremplir">
                        <input placeholder="Votre nouveau mail" type="text" name="mail" value="">
                        <input placeholder="Mot de passe" type="text" name="password" value="">

                    </div>


                    <div class="annulerOuValider">
                        <button class="annuler" type="button">
                            Annuler
                        </button>
                        <button class="valider">
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
                    <p> 13 rue des papeteries, 78000 Paris </p>
                    <button id="modifAdresse">
                        Modifier l'adresse mail
                    </button>
                </div>


                <form class="formModif" method="post" action="">

                    <div class="champsAremplir">
                        <div id="postalEtVille">
                            <input placeholder="Code postal" type="text" name="postal" value="">
                            <input placeholder="Ville" type="text" name="ville" value="">
                        </div>

                        <input placeholder="Adresse" type="text" name="password" value="">
                    </div>



                    <div class="annulerOuValider">
                        <button class="annuler" type="button">
                            Annuler
                        </button>
                        <button class="valider">
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
                    <p> ****** </p>
                    <button id="modifMdp">
                        Modifier le mot de passe
                    </button>
                </div>
                <form class="formModif" method="post" action="">
                    <div class="champsAremplir">
                        <input placeholder="Ancien mot de passe" type="text" name="password" value="">
                        <input placeholder="Nouveau mot de passe" type="text" name="password" value="">
                        <input placeholder="Confirmer le nouveau mot de passe" type="text" name="password" value="">

                    </div>


                    <div class="annulerOuValider">
                        <button class="annuler" type="button">
                            Annuler
                        </button>
                        <button class="valider">
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


        <form class="divPopUp">

            <div id="popUpSupprimerCompte">
                <section>
                    <p>
                        Supprimer définitivement votre compte ?
                    </p>
                </section>
                <div>
                    <p>
                        Cette action est irréversible, toutes les données relatives à votre profil seront effacées
                    </p>
                    <div>
                        <button id="annulerSupprimer"type="button">
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
<script src="../js/parametres.js"></script>

</html>
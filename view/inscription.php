<?php
    // Inclusion du framework
    include_once(__DIR__."/../framework/view.class.php");
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Inscription</title>
    <meta name="author" content="Yoan Delannoy" />
    <link rel="stylesheet" type="text/css" href="../design/inscription.css">
    <link rel="stylesheet" type="text/css" href="../design/crescendo.css">
</head>


<?php if(!isset($_SESSION)) { 
            session_start(); 
} ?>

<body class="dark-mode">
    <div id="inscription">

        <main>
            <a class="logo" href="../view/accueil.view.php"><img src="../design/image/logo_em.jpg"  alt="logo"></a>

            <div>
                <h1>Inscription</h1>
            </div>

            <div>
                <?php 

                if (isset($errors) && count($errors) != 0) {
                    foreach($errors as $e) { ?>
                        <p class="error"><?php echo($e->getMessage());?></p>
                        <?php
                    }
                } 
                ?>
            
            </div>

            <form action="../controller/inscription.ctrl.php" method="post">
                <div class="contenu">
                    <div class="block">
                        <article class="petit-article">
                            <label for="prenom">Prénom *</label>

                            <input type="text" name="prenom" value="<?=$prenom?>" id="prenom" placeholder="Entrez votre prénom" required>
                        </article>

                        <article class="petit-article">
                            <label for="nom">Nom *</label>

                            <input type="text" name="nom" value="<?=$nom?>" id="nom" placeholder="Entrez votre nom" required>
                        </article>

                        <article class="petit-article">
                            <label for="pseudo">Pseudo *</label>

                            <input type="text" name="pseudo" value="<?=$pseudo?>" id="pseudo" placeholder="Entrez votre pseudo" required>
                        </article>

                        <article class="petit-article">
                            <label for="birthday">Date de naissance *</label>

                            <input type="date" name="birthsday" value="<?=$birthsday?>" id="birthsday" min="1930-01-01" max="<?=$dateMinimale?>"
                                required>
                        </article>

                        <article class="ville">
                            <div>
                                <label for="code-postale">Code postal *</label>

                                <input type="text" name="code_postale" value="<?=$code_postale?>" id="code-postale" placeholder="Ex : 70123" minlength="5" maxlength="5" required>
                            </div>
                            <div>
                                <label for="ville">Ville *</label>

                                <input type="text" name="ville" value="<?=$ville?>" id="ville" placeholder="Ex : Paris" maxlength="30" required>
                            </div>
                        </article>

                        <article class="petit-article">
                            <label for="rue">Nom de la rue *</label>

                            <input type="text" name="rue" value="<?=$rue?>" id="rue" placeholder="Ex : 13 Rue des papeteries" required>
                        </article>
                    </div>

                    <div class="block">
                        <article class="petit-article">
                            <label for="adresseMail">Adresse mail *</label>

                            <input type="email" name="adresseMail" value="<?=$adresseMail?>" id="adresseMail"
                                placeholder="Entrez votre adresse mail" maxlength="40" required>
                        </article>

                        <article class="petit-article">
                            <label for="mdp">Mot de passe (au moins 12 caractères 1 majuscule et 1 caractère spécial) *</label>

                            <input type="password" name="mdp" id="mdp" required minlength=12 placeholder="Votre mot de passe">
                        </article>

                        <article class="petit-article">
                            <label for="verifmdp">Confirme ton mot de passe *</label>

                            <input type="password" name="verifmdp" id="verifmdp" required minlength=12>
                        </article>

                        <article class="article-condition-generale">
                            <input id="checkConditionGenerale" type="checkbox" name="conditions" required>
                            <p class="condition-generale"> En cochant la case, vous acceptez les <a class="condition"
                                    href="../view/conditionsUtilisation.view.php" target="_blank">CONDITIONS
                                    GÉNÉRALES D'UTILISATION</a> et la <a class="condition"
                                    href="" target="_blank">POLITIQUE DE PROTECTION DES DONNÉES</a></p>
                        </article>
                    </div>

                </div>
                <button type="submit" name="inscription" value="confirmer">S'INSCRIRE</button>
            </form>

            <p>Tu as déja un compte ?</p>
            <a href="../controller/login.ctrl.php" class="connexion">Connecte-toi</a>
        </main>
    </div>

</body>

</html>
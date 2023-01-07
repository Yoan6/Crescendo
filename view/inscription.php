<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inscription</title>
    <meta name="author" content="Yoan Delannoy" />
    <link rel="stylesheet" type="text/css" href="../design/inscription.css">
    <link rel="stylesheet" type="text/css" href="../design/header.css">
	<link rel="stylesheet" type="text/css" href="../design/crescendo.css">
  </head>
  <body class="dark-mode">

  <?php include(__DIR__.'/header.php'); ?>
  <div id="inscription">
    <main>
        <div>
            <h1>Inscription</h1>
        </div>
            <form action="inscription.ctrl.php" method="post">
                <article class="formulaire">
                    <div class="block">
                        <article class="petit-article">
                            <label for="prenom">Prénom *</label>
                            <br>
                            <input type="text" name="prenom" id="prenom" placeholder="Entrez votre prénom" required>
                        </article>

                        <article class="petit-article">
                            <label for="nom">Nom *</label>
                            <br>
                            <input type="text" name="nom" id="nom" placeholder="Entrez votre nom" required>
                        </article>

                        <article class="petit-article">
                            <label for="pseudo">Pseudo *</label>
                            <br>
                            <input type="text" name="pseudo" id="pseudo" placeholder="Entrez votre pseudo" required>
                        </article>

                        <article class="petit-article">
                            <label for="birthday">Date de naissance *</label>
                            <br>
                            <input type="date" name="birthday" id="birthsday" min="1930-01-01" max="2023-05-01" required>
                        </article>

                        <article class="petit-article">
                            <label for="birthday">Nom de la rue *</label>
                            <br>
                            <input type="text" name="rue" id="rue" placeholder="Ex : 13 Rue des papeteries" required>
                        </article>

                        <article class="ville">
                            <div>
                                <label for="code-postale">Code postale *</label>
                                <br>
                                <input type="text" name="code-postale" id="code-postale" placeholder="Ex : 70123" required>
                            </div>
                            <div>
                                <label for="ville">Ville *</label>
                                <br>
                                <input type="text" name="ville" id="ville" placeholder="Ex : Paris" required>
                            </div>
                        </article>
                    </div>
            
                    <div class="block">
                        <article class="petit-article">
                            <label for="adresseMail">Adresse mail *</label>
                            <br>
                            <input type="text" name="adresseMail" id="adresseMail" placeholder="Entrez votre adresse mail" required>
                        </article>

                        <article class="petit-article">
                            <label for="mdp">Mot de passe (au moins 12 caractères) *</label>
                            <br>
                            <input type="password" name="mdp" id="mdp" required minlength=12>
                        </article>

                        <article class="petit-article">
                            <label for="verifmdp">Confirme ton mot de passe *</label>
                            <br>
                            <input type="password" name="verifmdp" id="verifmdp" required minlength=12>
                        </article>

                        <article class="article-condition-generale">
                            <input type="checkbox" name="conditions" required>
                            <p class="condition-generale"> En cochant la case, vous acceptez les <a class="condition" href="conditionGenerale.php">CONDITIONS 
                                GÉNÉRALES D'UTILISATION</a> et la <a class="condition" href="protectionDonnee.php">POLITIQUE DE PROTECTION DES DONNÉES</a></p>
                        </article>
                    </div>
                    
                </article>
                <button type="submit" name="inscription">S'INSCRIRE</button>
            </form>
            <p>Tu as déja un compte ?</p>
            <a href="login.php" class="connexion">Connecte-toi</a>
        </main>
    </div>
    
    <?php include(__DIR__.'/footer.php'); ?>	
  </body>
</html>
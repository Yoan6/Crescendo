<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inscription</title>
    <meta name="author" content="Yoan Delannoy" />
    <link rel="stylesheet" type="text/css" href="../view/design/inscription.css">
  </head>
  <body>
    <header>
      <a href="index.controleur.php"><img src="../view/design/image/Crescendo.png" alt="logo"/></a>
      <p>Crescendo</p>
    </header>

    <div>
        <h1>Inscris-toi</h1>
    </div>

    <main>
        <form action="inscription.ctrl.php" method="post">
            <article class="formulaire">
                <div>
                    <article>
                        <label for="prenom">Prénom *</label>
                        <br>
                        <input type="text" name="prenom" id="prenom" required>
                    </article>

                    <article>
                        <label for="nom">Nom *</label>
                        <br>
                        <input type="text" name="nom" id="nom" required>
                    </article>

                    <article>
                        <label for="pseudo">Pseudo *</label>
                        <br>
                        <input type="text" name="pseudo" id="pseudo" required>
                    </article>

                    <article>
                        <label for="birthday">Date de naissance *</label>
                        <br>
                        <input type="text" name="birthday" id="birthsday" required>
                    </article>
                </div>
        
                <div>
                    <article>
                        <label for="adresseMail">Adresse email *</label>
                        <br>
                        <input type="text" name="adresseMail" id="adresseMail" required>
                    </article>

                    <article>
                        <label for="verifMail">Confirme ton adresse mail *</label>
                        <br>
                        <input type="text" name="verifMail" id="verifMail" required>
                    </article>

                    <article>
                        <label for="mdp">Mot de passe (au moins 12 caractères) *</label>
                        <br>
                        <input type="password" name="mdp" id="mdp" required minlength=12>
                    </article>

                    <article>
                        <label for="verifmdp">Confirme ton mot de passe *</label>
                        <br>
                        <input type="password" name="verifmdp" id="verifmdp" required minlength=12>
                    </article>

                    <article>
                        <input type="checkbox" name="conditions" required>
                        <p> En cochant la case, tu acceptes les <a class="condition" href="conditionGenerale.view.php">CONDITIONS GÉNÉRALES D'UTILISATION</a> et la <a class="condition" href="protectionDonnee">POLITIQUE DE PROTECTION DES DONNÉES</a></p>
                    </article>
                </div>
            </article>
            <button type="submit" name="inscription">S'inscrire</button>
        </form>
    </main>
  </body>
</html>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Login</title>
  <meta name="author" content="Yoan Delannoy" />
  <link rel="stylesheet" type="text/css" href="../design/connexion.css">
  <link rel="stylesheet" type="text/css" href="../design/crescendo.css">
</head>

<body class="dark-mode">


  <main id="connexion">
  <a class="logo" href="accueil.php"><img src="../design/image/crescendo_logo_black.svg"  alt="logo"></a>

    <h1>Connexion</h1>
    <form action="../controler/login.ctrl.php" method="post">
      <div>
        <label for="login">Adresse email / Pseudo : </label>
        <input class="input" id="login" type="text" name="login" value="" placeholder="Exemple : Bernard" required>
</div>
      <div>
        <label for="password">Mot de passe (au moins 12 caractères) : </label>
        <input class="input" id="password" type="password" name="password" value="" placeholder="Votre mot de passe"
          required>
      </div>
      <a class="MDPForgotten" href="">Mot de passe oublié ?</a>
      <button class="connexion" type="submit" name="connexion">SE CONNECTER</button>
      <a href="inscription.php" id="inscription" >S'INSCRIRE</a>

    </form>


  </main>

 
</body>

</html>
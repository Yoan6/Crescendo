<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Login</title>
  <meta name="author" content="Yoan Delannoy" />
  <link rel="stylesheet" type="text/css" href="../design/connexion.css">
  <link rel="stylesheet" type="text/css" href="../design/header.css">
  <link rel="stylesheet" type="text/css" href="../design/crescendo.css">
</head>

<body class="dark-mode">

  <?php
  include(__DIR__ . "/header.php");
  ?>

  <main id="connexion">
    <h1>Connexion</h1>
    <form action="../controler/login.ctrl.php" method="post">
      <p>
        <label for="login">Adresse email / Pseudo : </label>
        <br>
        <input class="input" id="login" type="text" name="login" value="" placeholder="ex : Artus" required>
      </p>
      <p>
        <label for="password">Mot de passe (au moins 12 caractères) : </label>
        <br>
        <input class="input" id="password" type="password" name="password" value="" placeholder="ex : ahdfukqshxsb"
          required>
      </p>
      <a class="MDPForgotten" href="">Mot de passe oublié ?</a>
      <button class="connexion" type="submit" name="connection">SE CONNECTER</button>
    </form>


    <form action="../controler/inscription.ctrl.php" method="post">
      <button class="inscription" type="submit" name="inscription">S'INSCRIRE</button>
    </form>
  </main>

  <?php
  include(__DIR__ . "/footer.php");
  ?>
</body>

</html>
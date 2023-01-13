<?php
    // Inclusion du framework
    include_once(__DIR__."/../framework/view.class.php");
?>

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

  <?php 
    if (isset($error) && count($error) != 0) {
      foreach($error as $e) {
        echo($e);
      }
    } 

    if(!isset($_SESSION)) { 
      session_start(); 
    } 
    
    // Si l'utilisateur est déja connecté on l'envoie sur la page accueil.php
    if(isset($_SESSION['num_utilisateur'])) {
        $view = new View();

        // Charge la vue
        $view->display("accueil.php");
        echo ("Vous êtes déja connecté !");
    } 
    ?>

    <h1>Connexion</h1>
    <form action="../controler/login.ctrl.php" method="post">
      <div>
        <label for="login">Adresse email / Pseudo : </label>
        <input class="input" id="login" type="text" name="login" value="" placeholder="Exemple : Bernard" required>
</div>
      <div>
        <label for="password">Mot de passe (au moins 12 caractères) : </label>
        <input class="input" id="password" type="password" name="password" value="" placeholder="Votre mot de passe"
          minlength="12" required>
      </div>
      <a class="MDPForgotten" href="">Mot de passe oublié ?</a>
      <button class="connexion" type="submit" name="connexion">SE CONNECTER</button>
      <a href="../view/inscription.php" id="inscription" >S'INSCRIRE</a>

    </form>


  </main>

 
</body>

</html>
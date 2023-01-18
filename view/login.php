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

<?php // if(isset($errors) && count($errors) > 0) include(__DIR__ . '/popup/erreur.view.php'); ?>
<?php if(isset($messages) && count($messages) > 0) include(__DIR__ . '/popup/message.view.php'); ?>
<body class="dark-mode">


  <main id="connexion">
  <a class="logo" href="../controller/accueil.ctrl.php"><img src="../design/image/logo_em.jpg"  alt="logo"></a>
    <h1>Connexion</h1>
    <form action="../controller/login.ctrl.php" method="post">
      <div>
        <label for="login">Adresse email / Pseudo : </label>
        <input class="input" id="login" type="text" name="login" value="<?=$login?>" placeholder="Exemple : Bernard" required>
      </div>
      <div>
        <label for="password">Mot de passe (au moins 12 caractères) : </label>
        <input class="input" id="password" type="password" name="password" value="" placeholder="Votre mot de passe"
          minlength="12" required>
      </div>
      <a class="MDPForgotten" href="" target="_blank">Mot de passe oublié ?</a>
      <button class="connexion" type="submit" name="connexion" value="">SE CONNECTER</button>
      <a href="../controller/inscription.ctrl.php" id="inscription" >S'INSCRIRE</a>

      <div>
        <?php 

        if (isset($errors) && count($errors) != 0) {
          foreach($errors as $e) { ?>
            <p class="error"><?php echo($e);?></p>
            <?php
          }
        } 
        ?>
    
      </div>

    </form>


  </main>

 
</body>

</html>
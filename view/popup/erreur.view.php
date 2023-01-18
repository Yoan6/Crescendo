<link rel="stylesheet" type="text/css" href="../design/connexion.css">

<?php foreach($errors as $error) : ?>
<div id="bandeau2">
    <div class="bandeauDiv1">

    </div>
    <div class="bandeauDiv2">
        <h3><?=$error?></h3>
    </div>
    <div class="bandeauDiv3">
        <button class="btnFermer"> 
            <a href="../controller/accueil.ctrl.php"> Fermer </a>
        </button>
    </div>
</div>  
<?php endforeach; ?>
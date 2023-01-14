<?php foreach($errors as $error) : ?>
<div id="bandeau2">
    <div class="bandeauDiv1">

    </div>
    <div class="bandeauDiv2">
        <h3><?=$error?></h3>
    </div>
    <div class="bandeauDiv3">
        <button class="btnFermer"> Fermer </button>
    </div>
</div>  
<?php endforeach; ?>
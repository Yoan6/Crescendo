<?php foreach($messages as $message) : ?>
    <?="hello"?>
    <div id="bandeau1">
        <div class="bandeauDiv1">

        </div>
        <div class="bandeauDiv2">
                <h3><?=$message?></h3>
        </div>
        <div class="bandeauDiv3">
            <button class="btnFermer"> Fermer </button>
        </div>
    </div>  
<?php endforeach; ?>
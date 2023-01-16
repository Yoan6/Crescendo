<!--Informer l'utilisateur-->
<option value="">Selectionner Taille</option>


<!--Liste d'initialisation-->
<?php $tailles = ["XS","S","M","X","XL"];?>

<!--Traverser la liste pour créer des balises <option></option>-->
<?php foreach($tailles as $tailleListe) : ;?> 
    <option value="<?= $tailleListe ?>" 
        <?php if ($taille == $tailleListe)
                echo 'selected'; //Si le taille est choisie alors garder l'option lors d'un refresh de page?> 
    >
    <?=$tailleListe?>
    </option>
<?php endforeach;?>

<!--Informer l'utilisateur-->
<option value="">Selectionner Taille</option>


<!--Liste d'initialisation-->
<?php $tailles = ["XS","S","M","X","XL"];?>

<!--Traverser la liste pour créer des balises <option></option>-->
<?php foreach($tailles as $taille) : ;?> 
    <option value="<?= $taille ?>" 
        <?php if (isset($_POST['taille']) && $_POST['taille'] == $taille)
                echo 'selected'; //Si le taille est choisie alors garder l'option lors d'un refresh de page?> 
    >
    <?=$taille?>
    </option>
<?php endforeach;?>

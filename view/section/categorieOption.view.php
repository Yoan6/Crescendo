<!--Informer l'utilisateur-->
<option value="">Selectionner Catégorie</option>


<!--Liste d'initialisation-->
<?php $categories = ["Vêtement","Instrument","Accessoire","Autres"];?>

<!--Traverser la liste pour créer des balises <option></option>-->
<?php foreach($categories as $categorie) : ;?> 
    <option value="<?= $categorie ?>" 
        <?php if (isset($_POST['categorie']) && $_POST['categorie'] == $categorie)
                echo 'selected'; //Si la catégorie est choisie alors garder l'option lors d'un refresh de page?> 
    >
    <?=$categorie?>
    </option>
<?php endforeach;?>

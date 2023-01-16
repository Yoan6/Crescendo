<!--Informer l'utilisateur-->
<option value="">Selectionner Catégorie</option>


<!--Liste d'initialisation-->
<?php $categories = ["Vêtement","Instrument","Accessoire","Autres"];?>

<!--Traverser la liste pour créer des balises <option></option>-->
<?php foreach($categories as $categorieListe) : ;?> 
    <option value="<?= $categorieListe ?>" 
        <?php if ($categorie == $categorieListe)
                echo 'selected'; //Si la catégorie est choisie alors garder l'option lors d'un refresh de page?> 
    >
    <?=$categorieListe?>
    </option>
<?php endforeach;?>

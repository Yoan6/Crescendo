<!--Informer l'utilisateur-->
<option value="">Selectionner Style</option>


<!--Liste d'initialisation-->
<?php $styles = ["Blues","Classique","Disco","Electro","Funk","Hip-hop","Jazz","Metal","Musique de film","Pop","Reggae","Rock","Techno","Autres"];?>

<!--Traverser la liste pour créer des balises <option></option>-->
<?php foreach($styles as $style) : ;?> 
    <option value="<?= $style ?>" 
        <?php if (isset($_POST['style']) && $_POST['style'] == $style)
                echo 'selected'; //Si le style est choisie alors garder l'option lors d'un refresh de page?> 
    >
    <?=$style?>
    </option>
<?php endforeach;?>

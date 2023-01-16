<!--Informer l'utilisateur-->
<option value="">Selectionner Style</option>


<!--Liste d'initialisation-->
<?php $styles = ["Blues","Chanson Francaise","Classique","Disco","Electro","Funk","Hip-hop","Jazz","Metal","Musique de Film","Pop","Reggae","Rap","Rock","Techno","Autres"];?>

<!--Traverser la liste pour créer des balises <option></option>-->
<?php foreach($styles as $styleListe) : ;?> 
    <option value="<?= $styleListe ?>" 
        <?php if ($style == $styleListe)
                echo 'selected'; //Si le style est choisie alors garder l'option lors d'un refresh de page?> 
    >
    <?=$styleListe?>
    </option>
<?php endforeach;?>

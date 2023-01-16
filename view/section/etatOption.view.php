<!--Informer l'utilisateur-->
<option value="">Selectionner Etat</option>


<!--Liste d'initialisation-->
<?php $etats = ["Très mauvais","Mauvais","Moyen","Bon","Très Bon"];?>

<!--Traverser la liste pour créer des balises <option></option>-->
<?php foreach($etats as $etatListe) : ;?> 
    <option value="<?= $etatListe ?>" 
        <?php if ($etat == $etatListe)
                echo 'selected'; //Si l'état est choisie alors garder l'option lors d'un refresh de page?> 
    >
    <?=$etatListe?>
    </option>
<?php endforeach;?>
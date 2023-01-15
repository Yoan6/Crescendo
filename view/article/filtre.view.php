<!--Informer l'utilisateur-->
<option value="">Trier par</option>

<!--Liste d'initialisation-->
<?php $lesFiltres = [["value" => "artiste", "name" =>"artiste A-Z", "orderBy" => "ASC"]];?>

<!--Traverser la liste pour créer des balises <option></option>-->
<?php foreach($lesFiltres as $filtre) : ;?> 
    <option value="">Trier par</option>
        <option value="<?=$filtre['value']?>"><?=$filtre['name']?> <input type="hidden" name="orderBy" value="<?=$filtre['orderBy']?>"> </option>
        <option value="2">artiste Z-A</option>
    </option>
<?php endforeach;?>

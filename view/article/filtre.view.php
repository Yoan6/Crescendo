
    
    <?php 
    // Liste d'initialisation
    $lesFiltres = [
                        "artiste" =>"artiste A-Z", 
                        "artiste" => "artiste Z-A",
                        "prix_actuel" =>"prix ↗", 
                        "prix_actuel" => "prix ↘"
                        ];
    ?>



<select id="orderBy">
    <!--Informer l'utilisateur-->
    <option value="">Trier par</option>


    <!--Traverser la liste pour créer des balises <option></option>-->
    <?php foreach($lesFiltres as $filtre => $label) : ;?> 
        <option value="<?=$filtre?>"><?=$label?></option>
    <?php endforeach;?>
</select>
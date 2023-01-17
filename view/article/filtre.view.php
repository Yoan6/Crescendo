<?php
// Liste d'initialisation
$lesFiltres = [
    1 => ["key" => "artiste", "sens" => "ASC", "value" => "artiste A-Z"],
    2 => ["key" => "artiste", "sens" => "DESC", "value" => "artiste Z-A"],
    3 => ["key" => "prix_actuel", "sens" => "ASC","value" => "prix ↗"],
    4 => ["key" => "prix_actuel", "sens" => "DESC", "value" => "prix ↘"]
];
//orderByChoix=prix_actuel&orderBy=DESC
//orderByChoix=filtre&orderBy= 


?>



<select id="orderBy">
    <!--Informer l'utilisateur-->
    <option id="defaultOption" value="">Trier par</option>
    <!--Traverser la liste pour créer des balises <option></option>-->
    <?php foreach ($lesFiltres as $num => $filtre): ?>
        <option class="optionOrderByChoix" value="<?= $filtre['key']?>">
            <?= $filtre['value'] ?>
        </option>
    <?php endforeach; ?>
    
</select>

    <!--On ne peut pas mettre de input dans un select-->

<?php foreach ($lesFiltres as $num => $filtre): ?>

<input class="inputOrderBy" type="hidden" name="orderBy" value="<?= $filtre['sens'] ?>">
<?php endforeach; ?>

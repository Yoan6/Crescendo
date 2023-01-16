<?php
//Initialisation des listes
$checkboxListe =
[
"style" => ["Blues", "Chanson Francaise", "Classique", "Disco", "Electro", "Funk", "Hip-hop", "Jazz", "Metal", "Musique de Film", "Pop", "Reggae", "Rap", "Rock", "Techno", "Autres"],
"taille" => ["XS", "S", "M", "X", "XL"],
"categorie" => ["Vêtement","Instrument","Accessoire","Autres"],
"etat" => ["Très mauvais","Mauvais","Moyen","Bon","Très Bon"]
];
?>
<form class="filtre" action = "rechercheChoix.ctrl.php?<?=(isset($recherche) ? $recherche : "")?>">
    <div>
        <?php foreach($checkboxListe as $choix => $valeursChoix) : ?> 
        <div>
            <button type="button" class="buttonDropFilter" tag="0">
                <h3><?=$choix?></h3>
                <svg class="plus" fill="#000000" viewBox="0 0 32 32" version="1.1"
                    xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_iconCarrier">
                        <title>plus</title>
                        <path
                            d="M30 14.75h-12.75v-12.75c0-0.69-0.56-1.25-1.25-1.25s-1.25 0.56-1.25 1.25v0 12.75h-12.75c-0.69 0-1.25 0.56-1.25 1.25s0.56 1.25 1.25 1.25v0h12.75v12.75c0 0.69 0.56 1.25 1.25 1.25s1.25-0.56 1.25-1.25v0-12.75h12.75c0.69 0 1.25-0.56 1.25-1.25s-0.56-1.25-1.25-1.25v0z">
                        </path>
                    </g>
                </svg>
                <svg class="minus" fill="#000000" viewBox="0 0 32 32" version="1.1"
                    xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_iconCarrier">
                        <title>minus</title>
                        <path
                            d="M30 14.75h-28c-0.69 0-1.25 0.56-1.25 1.25s0.56 1.25 1.25 1.25v0h28c0.69 0 1.25-0.56 1.25-1.25s-0.56-1.25-1.25-1.25v0z">
                        </path>
                    </g>
                </svg>
            </button>

            <div class="filterdown">
                <?php foreach($valeursChoix as $valeurChoix) :?> 
                <div>
                    <input type="checkbox" id="<?=$valeurChoix?>" name="choix[<?=$choix?>][]" value="<?=$valeurChoix?>">
                    <label for="<?=$valeurChoix?>"><?=$valeurChoix?></label>
                </div>

                <?php endforeach;?> 
            </div>

        </div>
        <?php endforeach;?> 

    </div>


    <div id="validerOuEffacer">
        <button>
            Valider
        </button>
        <button id="toutEffacer" type="button">
            Tout effacer
        </button>
    </div>


</form>
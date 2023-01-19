tester = document.getElementById("testAEnlever");

var lesEncheres = document.getElementsByClassName("numEnchereRecupererValeur");
var numUtilisateur =  document.getElementsByClassName("numUtilisateurRecupererValeur")[0].value;
var estFavoris = document.getElementsByClassName('estFavoris');


    var heartBouton = document.getElementsByClassName("heartBouton"); // Le bouton like 


/**
 * récupérer toutes les articles pour les actualiser en récupérant les bons numéros
 * 
 */
if (listeUsers !== 0) {




for(let i =0; i< lesEncheres.length; i++) { // Le numéro d'enchère à été mis ou la classe de l'objet
    // Données
    

    if(estFavoris[i].innerHTML == '1') {
        heartBouton[i].classList.add("favoris");
    } 

    // Events
    heartBouton[i].addEventListener("click", function() {setFavoris(lesEncheres[i].value,numUtilisateur,1, i);});

}


/**
 * Favoriser
 * @param {*} numEnchere 
 * @param {*} numUtilisateur 
 * @param {*} estFavoris 1 = true et 0 = false
 */
function setFavoris(numEnchere,numUtilisateur,estFavoris, i) {
    // Créer l'objet XMLHttpRequest
    var xmlhttp = new XMLHttpRequest();

    // Quand le serveur est prêt, changer remplir le coeur
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Faire le changement en css
            //------------------------------------------------------------  ici
            heartBouton[i].classList.toggle("favoris");
            
        }
    }

    // Demander le fichier avec la fonction à exécuter
    xmlhttp.open("GET","../ajax/setFavoris.php?numEnchere=" + numEnchere +"&numUtilisateur=" + numUtilisateur+"&estFavoris=" + estFavoris);
    xmlhttp.send();
}

}
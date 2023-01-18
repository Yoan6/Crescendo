tester = document.getElementById("testAEnlever");

var lesEncheres = document.getElementsByClassName("numEnchereRecupererValeur");
var numUtilisateur =  document.getElementsByClassName("numUtilisateurRecupererValeur")[0].value;


/**
 * récupérer toutes les articles pour les actualiser en récupérant les bons numéros
 * 
 */
for(let i =0; i< lesEncheres.length; i++) { // Le numéro d'enchère à été mis ou la classe de l'objet
    // Données
    let numEnchere =  lesEncheres[i].value;
    var heartBouton = document.getElementsByClassName("heartBouton")[i]; // Le bouton like 


    // Events
    heartBouton.addEventListener("click", function() {setFavoris(numEnchere,numUtilisateur,1);});

}


/**
 * Favoriser
 * @param {*} numEnchere 
 * @param {*} numUtilisateur 
 * @param {*} estFavoris 1 = true et 0 = false
 */
function setFavoris(numEnchere,numUtilisateur,estFavoris) {
    // Créer l'objet XMLHttpRequest
    var xmlhttp = new XMLHttpRequest();

    // Quand le serveur est prêt, changer remplir le coeur
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Faire le changement en css
            //------------------------------------------------------------  ici
            tester.innerHTML = this.responseText;
        }
    }

    // Demander le fichier avec la fonction à exécuter
    xmlhttp.open("GET","../ajax/setFavoris.php?numEnchere=" + numEnchere +"&numUtilisateur=" + numUtilisateur+"&estFavoris=" + estFavoris);
    xmlhttp.send();
}
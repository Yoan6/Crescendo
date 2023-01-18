
//var tester = document.getElementById("testAEnlever");



var lesEncheres = document.getElementsByClassName("numEnchereRecupererValeur");
var numUtilisateur =  document.getElementsByClassName("numUtilisateurRecupererValeur")[0].value;



/**
 * récupérer toutes les articles pour les actualiser en récupérant les bons numéros
 * 
 */
for(let i =0; i< lesEncheres.length; i++) { // Le numéro d'enchère à été mis avec la classe de l'objet
    // Données
    let numEnchere =  lesEncheres[i].value;
    var likeActuelText = document.getElementsByClassName("likeActuelText")[i]; // C'est l'endroit pour le nombre de like 
    var likeBouton = document.getElementsByClassName("likeBouton")[i]; // Le bouton like 
    var dislikeBouton = document.getElementsByClassName("dislikeBouton")[i]; // Le bouton dislike

    // Events
    likeActuelText.addEventListener("load", getLikeActuel(numEnchere,likeActuelText));
    likeBouton.addEventListener("click", function() {setLike(numEnchere,numUtilisateur,1);});
    dislikeBouton.addEventListener("click", function() {setLike(numEnchere,numUtilisateur,0);});

    setInterval(getLikeActuel,60000,numEnchere,likeActuelText);  // 1000 ms = 1s, note ne pas mettre les parenthèses on parle de la fonction
}




/**
 * Changer le compteur 
 * @param {*} numEnchere 
 * @param {*} likeActuelText 
 */
function getLikeActuel(numEnchere,likeActuelText) {
    // Créer l'objet XMLHttpRequest
    var xmlhttp = new XMLHttpRequest();
    
    // Quand le serveur est prêt, changer le texte du nombre de likes de la vue
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            likeActuelText.innerHTML = this.responseText;
            getLikeActuel(numEnchere,likeActuelText);
        }
    }

    // Demander le fichier avec la fonction à exécuter
    xmlhttp.open("GET","../ajax/getLikeActuel.php?numEnchere=" + numEnchere);
    xmlhttp.send();
}
   

/**
 * Mettre un like ou un dislike
 * @param {*} numEnchere 
 * @param {*} numUtilisateur 
 * @param {*} estLike 1 = true et 0 = false
 */
function setLike(numEnchere,numUtilisateur,estLike) {
    // Créer l'objet XMLHttpRequest
    var xmlhttp = new XMLHttpRequest();

    // Quand le serveur est prêt, changer le texte du nombre de likes de la vue
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Faire le changement en css
            //tester.innerHTML = this.responseText;
        }
    }

    // Demander le fichier avec la fonction à exécuter
    xmlhttp.open("GET","../ajax/setLike.php?numEnchere=" + numEnchere +"&numUtilisateur=" + numUtilisateur+"&estLike=" + estLike);
    xmlhttp.send();
}


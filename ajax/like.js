var lesEncheres = document.getElementsByClassName("numEnchereRecupererValeur");
var numUtilisateur =  document.getElementsByClassName("numUtilisateurRecupererValeur").value;


// récupérer toutes les articles pour les actualiser en récupérant les bons numéros
for(let i =0; i< lesEncheres.length; i++) {
    // Données
    var numEnchere =  lesEncheres[i].value;
    var likeActuelText = document.getElementById("likeActuelText" + numEnchere);
    var likeBouton = document.getElementsByClassName("likeBouton" + numEnchere)[0];
    var dislikeBouton = document.getElementsByClassName("dislikeBouton" + numEnchere)[0];

    // Events
    likeActuelText.addEventListener("load", getLikeActuel(numEnchere));
    likeBouton.addEventListener("onClick", setLike(numEnchere,numUtilisateur,true));
    dislikeBouton.addEventListener("onClick", setLike(numEnchere,numUtilisateur,false));

    setInterval(getLikeActuel,3000,numEnchere,likeActuelText);  // 1000 ms = 1s, note ne pas mettre les parenthèses on parle de la fonction
}

function getLikeActuel(numEnchere,likeActuelText) {
    // Créer l'objet XMLHttpRequest
    var xmlhttp = new XMLHttpRequest();
    
    // Quand le serveur est prêt, changer le texte du nombre de likes de la vue
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            likeActuelText.innerHTML = this.responseText;
        }
    }

    // Demander le fichier avec la fonction à exécuter
    xmlhttp.open("GET","/crescendo/ajax/getLikeActuel.php?numEnchere=" + numEnchere);
    xmlhttp.send();
}
   

    

function setLike(numEnchere,numUtilisateur,estLike) {
    // Créer l'objet XMLHttpRequest
    var xmlhttp = new XMLHttpRequest();

    // Quand le serveur est prêt, changer le texte du nombre de likes de la vue
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Faire le changement en css
        }
    }

    // Demander le fichier avec la fonction à exécuter
    xmlhttp.open("GET","/crescendo/ajax/setLike.php?numEnchere=" + numEnchere +"&numUtilisateur=" + numUtilisateur+"&estLike=" + estLike);
    xmlhttp.send();
}



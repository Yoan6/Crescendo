var lesEncheres = document.getElementsByClassName("numEnchereRecupererValeur");
var numUtilisateur =  document.getElementsByClassName("numUtilisateurRecupererValeur").value;


// récupérer toutes les articles pour les actualiser en récupérant les bons numéros
for(let i =0; i< lesEncheres.length; i++) {
    // Données
    var numEnchere =  lesEncheres[i].value;
    var coeur = document.getElementById("likeActuelText" + numEnchere);


    // Events
    likeActuelText.addEventListener("load", getLikeActuel(numEnchere));


    setInterval(getLikeActuel,3000,numEnchere,likeActuelText);  // 1000 ms = 1s, note ne pas mettre les parenthèses on parle de la fonction
}

function favorise(numEnchere) {

}
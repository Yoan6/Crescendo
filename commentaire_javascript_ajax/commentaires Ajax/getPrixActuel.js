
var numEnchere =  document.getElementById("numEnchere").value;

// récupérer la box à changer
var prixActuelText = document.getElementById("prixActuelText");


prixActuelText.addEventListener("load", getPrixActuel(numEnchere));

//On actualise le prix toute les 3 secondes
setInterval(getPrixActuel,3000,numEnchere);  // 1000 ms = 1s


function getPrixActuel(numEnchere) {

   
    // Créer l'objet XMLHttpRequest
    var xmlhttp = new XMLHttpRequest();

    // Quand le serveur est prêt, changer le texte du prix de la vue
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            prixActuelText.innerHTML = this.responseText;
            if(inputPrix !== null){
                inputPrix.setAttribute("min", (parseInt(this.responseText) + 1));
            }
        }
    }

    // Demander le fichier avec la fonction à exécuter
    xmlhttp.open("GET","../ajax/getPrixActuel.php?numEnchere=" + numEnchere);
    xmlhttp.send();
}
   




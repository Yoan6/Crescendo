var inputPrix = document.getElementById("inputPrix");

var numEnchere =  document.getElementById("numEnchere").value;


var prixActuelText = document.getElementById("prixActuelText");

prixActuelText.addEventListener("load", getPrixActuel(numEnchere));

setInterval(getPrixActuel,3000,numEnchere);  // 1000 ms = 1s


function getPrixActuel(numEnchere) {
    // récupérer la box à changer
   

    // Créer l'objet XMLHttpRequest
    var xmlhttp = new XMLHttpRequest();

    // Quand le serveur est prêt, changer le texte du prix de la vue
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            prixActuelText.innerHTML = this.responseText;
            inputPrix.setAttribute("min", (parseInt(this.responseText) + 1));
        }
    }

    // Demander le fichier avec la fonction à exécuter
    xmlhttp.open("GET","../ajax/getPrixActuel.php?numEnchere=" + numEnchere);
    xmlhttp.send();
}
   



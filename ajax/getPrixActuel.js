function getPrixActuel(numEnchere) {
    // récupérer la box à changer
    boxAChanger = document.getElementById("prixActuelText");

    // Créer l'objet XMLHttpRequest
    var xmlhttp = new XMLHttpRequest();

    // Quand le serveur est prêt, changer le texte du prix de la vue
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            boxAChanger.innerHTML = this.responseText;
        }
    }

    // Demander le fichier avec la fonction à exécuter
    xmlhttp.open("GET","getPrixActuel.php?numEnchere=" + numEnchere);
    xmlhttp.send();
}
   

function reactualiserPrixActuel(numEnchere) {
    setInterval(getPrixActuel,1000,numEnchere);  // 1000 ms = 1s
    // Note : ne pas mettre les parenthèse à la fonction, sinon c'est considéré comme une valeur et non la fonction 
}



//On récupère la date de fin de l'enchère 
var dateFin = document.getElementsByClassName('leTimerDeLArticle')[0];


//On vérifie que la date de fin existe bien
if (typeof dateFin !== 'undefined') { 

//On récupère la valeur de la date de fin
var dateFinValeur = dateFin.value;
var leTimerConteneur = document.getElementsByClassName('affichageTemps')[0];



//On lance la fonction d'avoirTemps() au chargement de la page
window.addEventListener("load", avoirTemps());
//On lance la fonction d'avoirTemps() toutes les 1seconde
setInterval(function (){avoirTemps()}, 1000);


function avoirTemps() {
    //on récupère la date actuelle
    let time =  new Date().getTime();
    //On calcule la date de fin (en milliseconde)
    let dateFin = new Date(dateFinValeur).getTime();
    //On calcule le temps restant
    let decompteMiliSecond = dateFin - time;

    //On convertie les mesures en jours, heures, minutes et secondes
    let jour = Math.floor(decompteMiliSecond / 1000 / 60 / 60 / 24); // s / min // h // j
    let h = Math.floor(decompteMiliSecond / 1000 / 60 / 60) % 24;
    let m =  Math.floor(decompteMiliSecond / 1000 / 60) % 60;
    let s = Math.floor(decompteMiliSecond / 1000) % 60;

    //On affiche le temps restant dans un conteneur
    leTimerConteneur.innerHTML = jour + "j " + h + "h " + m + "m " + s + "s";
}


}



var dateFin = document.getElementsByClassName('leTimerDeLArticle')[0];
if (typeof dateFin === 'undefined') { 
var dateFinValeur = dateFin.value;
var leTimerConteneur = document.getElementsByClassName('affichageTemps')[0];




window.addEventListener("load", avoirTemps());
setInterval(function (){avoirTemps()}, 1000);


function avoirTemps() {
    let time =  new Date().getTime();
    let dateFin = new Date(dateFinValeur).getTime();
    let decompteMiliSecond = dateFin - time;

    let jour = Math.floor(decompteMiliSecond / 1000 / 60 / 60 / 24); // s / min // h // j
    let h = Math.floor(decompteMiliSecond / 1000 / 60 / 60) % 24;
    let m =  Math.floor(decompteMiliSecond / 1000 / 60) % 60;
    let s = Math.floor(decompteMiliSecond / 1000) % 60;

    leTimerConteneur.innerHTML = jour + "j " + h + "h " + m + "m " + s + "s";
}


}


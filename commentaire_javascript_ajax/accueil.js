
// Ici on s'occupe du popUp pour les cookies de la page d'accueuil 



//Pour les switch de consentement obligatoires
var switchConsentement_oblige = document.getElementsByClassName('switchConsentement oblige');

var obligatoire = document.getElementsByClassName('obligatoire');
var accepterCookies = document.getElementById('accepterCookies');

//On coche donc automatiquement les switch obligatoires
for(var i = 0; i < switchConsentement_oblige.length; i++) {
//on coche les switch obligatoires
switchConsentement_oblige[i].click();
switchConsentement_oblige[i].checked = true;
//on désactive les cliques sur les switch obligatoires (pour ne pas pouvoir décocher)
switchConsentement_oblige[i].style.pointerEvents = "none";
}


//On prend l'élément caché qui nous passe l'information de si les cookies ont déjà été acceptés ou non
var cookiesDejaAccepte = document.getElementById('cookiesDejaAccepte');
//Le popUp des cookies
var popUpCookies = document.getElementsByClassName('popUpCookie')[0];


//Si les cookies ont déjà été acceptés, on cache le popUp
if(cookiesDejaAccepte.innerHTML == "true") {
popUpCookies.style.display = "none";
} else {
    //Sinon on bloque le scroll de la page d'accueil et le popUp s'affiche par défaut
    var page = document.getElementsByTagName('body')[0];
    page.classList.add('noscroll');


}
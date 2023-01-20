

var switchConsentement_oblige = document.getElementsByClassName('switchConsentement oblige');

var obligatoire = document.getElementsByClassName('obligatoire');
var accepterCookies = document.getElementById('accepterCookies');

for(var i = 0; i < switchConsentement_oblige.length; i++) {
switchConsentement_oblige[i].click();

switchConsentement_oblige[i].style.pointerEvents = "none";
switchConsentement_oblige[i].checked = true;
}

var cookiesDejaAccepte = document.getElementById('cookiesDejaAccepte');
var popUpCookies = document.getElementsByClassName('popUpCookie')[0];

if(cookiesDejaAccepte.innerHTML == "true") {
popUpCookies.style.display = "none";
} else {
    var page = document.getElementsByTagName('body')[0];
    page.classList.add('noscroll');


}
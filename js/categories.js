
var dropdownButton = document.getElementsByClassName("buttonDropFilter");
var dropdownFilter = document.getElementsByClassName("filterdown");
var plus = document.getElementsByClassName("plus");
var minus = document.getElementsByClassName("minus");
const validerOuEffacer = document.getElementById("validerOuEffacer");


let animationEnCours = false;

// Toggle dropdown function

const toggleDropFilter = function (numero) {
  if (!animationEnCours) {
    dropdownButton[numero].removeEventListener("click", this, false);
    animationEnCours = true;


    if (plus[numero].style.display === "inline") {
      dropdownButton[numero].style.borderRadius = "15px 15px 0px 0px";
      setTimeout(function () {
        // code à exécuter après un délai de 2 secondes
        dropdownFilter[numero].classList.toggle("open");
        plus[numero].style.display = "none";
        minus[numero].style.display = "inline";
        validerOuEffacer.style.maxHeight = "1000px";
        validerOuEffacer.style.visibility = "visible";
        validerOuEffacer.style.opacity = "1";


      }, 100);


    } else {
      setTimeout(function () {
        dropdownButton[numero].style.borderRadius = "15px";
      }, 700);
      dropdownFilter[numero].classList.toggle("open");
      plus[numero].style.display = "inline";
      minus[numero].style.display = "none";

      //on vérifie si toute les fenetres sont fermé et si c'est le cas on ferme le "ValiderOuEffacer"
      let toutReduit = true;
      for (let i = 0; i < dropdownButton.length; i++) {
        if (dropdownFilter[i].classList.contains("open")) {
          toutReduit = false;
        }
      }

      if (toutReduit === true) {
        validerOuEffacer.style.maxHeight = "0px";
        validerOuEffacer.style.visibility = "hidden";
        validerOuEffacer.style.opacity = "0";
      }
    }
  }
  dropdownButton[numero].addEventListener("click", this, false);
  animationEnCours = false;
}


for (let i = 0; i < dropdownButton.length; i++) {
  validerOuEffacer.style.maxHeight = "0px";
  dropdownButton[i].style.display = "flex";
  minus[i].style.display = "none";
  plus[i].style.display = "inline";

  //dropdownFilter[i].setAttribute("myParametre", i);


  // Toggle dropdown open/close when dropdown button is clicked
  /* 
  dropdownButton[i].addEventListener("click", function(event) {
    event.stopPropagation();
    toggleDropFilter(event.currentTarget.myParametre);
  });
  */


  dropdownButton[i].addEventListener("click", toggleDropFilter.bind(null, i), false);


}



/*
document.getElementsByClassName("buttonDropFilter").onclick = function() {
  var dropdownButton = document.getElementsByClassName("buttonDropFilter");
  dropdownButton.classList.toggle("menu-open");
};

*/



//whene the select is changed, we reload the page with GET parameters
var inputOrderBy = document.getElementsByClassName("inputOrderBy");
var optionOrderByChoix = document.getElementsByClassName("optionOrderByChoix");
var orderBy = document.getElementById("orderBy");
var defaultOption = document.getElementById("defaultOption");


//on récupère les paramètres GET
const params = new Proxy(new URLSearchParams(window.location.search), {
  get: (searchParams, prop) => searchParams.get(prop),
});

//on vérifie si il y a des paramètres GET et on change la valeur du select
if (params.orderBy === "ASC") {
  orderBy.value = params.orderByChoix;
} else if (params.orderBy === "DESC") {
  orderBy.value = params.orderByChoix;
  orderBy.selectedIndex = orderBy.selectedIndex + 1;
}



orderBy.addEventListener("change", function () {


  var url = new URL(window.location.href);
  if(orderBy.selectedIndex === 0) {
    url.searchParams.delete("orderByChoix");
    url.searchParams.delete("orderBy");
  }else {
  url.searchParams.set("orderByChoix", optionOrderByChoix[orderBy.selectedIndex - 1].value);
  url.searchParams.set("orderBy", inputOrderBy[orderBy.selectedIndex - 1].value);
  }
  window.location.href = url.href;

});




//on récupère les paramètres GET
const parameters = new URLSearchParams(window.location.search);
const categories = parameters.getAll("choixObligatoire[categorie][]");
const styles = parameters.getAll("choix[style][]");
const taille = parameters.getAll("choix[taille][]");
const etat = parameters.getAll("choix[etat][]");

function remettrelesparameters(unParametre){
  for (let i = 0; i < unParametre.length; i++) {
    var checkbox = document.getElementById(unParametre[i]);
    checkbox.checked = true;
  }
}


remettrelesparameters(categories);
remettrelesparameters(styles);
remettrelesparameters(taille);
remettrelesparameters(etat);





var pageDebut = document.getElementById("pageDebut");
var pagePrecedante = document.getElementById("pagePrecedante");
var pageFin = document.getElementById("pageFin");
var pageSuivante = document.getElementById("pageSuivante");
var numeroDePage = document.getElementsByClassName("numeroDePage");

function rajoutDeParametre(url, parametre, valeur) {
  url.searchParams.set(parametre, valeur);
  return url;
}

for (let i = 0; i < numeroDePage.length; i++) {
  //On rajoute les paramètres GET déjà présent au lien du bas de page pour conserver les filtres
  for(let [key, value] of parameters) {
    numeroDePage[i].href = rajoutDeParametre(new URL(numeroDePage[i].href), key, value);
  }
  
}

for(let [key, value] of parameters) {
  if(key !== "page") {
  pageDebut.href = rajoutDeParametre(new URL(pageDebut.href), key, value);
  pagePrecedante.href = rajoutDeParametre(new URL(pagePrecedante.href), key, value);
  pageFin.href = rajoutDeParametre(new URL(pageFin.href), key, value);
  pageSuivante.href = rajoutDeParametre(new URL(pageSuivante.href), key, value);
  }
}

/*
//Lors du chargement de la page, on vérifie si il y a des paramètres GET et on change la valeur du select
var url = new URL(window.location.href);
var orderBy = document.getElementById("orderBy");
if (url.searchParams.get("orderBy")) {
  orderBy.value = url.searchParams.get("orderBy");
}
*/



//////////////////////////
//Tout décocher//////////
////////////////////////

toutEffacer = document.getElementById("toutEffacer");

// Sélectionner toutes les checkbox de la page
var checkboxes = document.querySelectorAll('input[type=checkbox]');

// Boucle sur toutes les checkbox et les décocher
toutEffacer.addEventListener("click", function () {
  for (var i = 0; i < checkboxes.length; i++) {
    checkboxes[i].checked = false;
  }
});

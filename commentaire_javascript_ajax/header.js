const dropdownBtn = document.getElementById("btn");
const dropdownMenu = document.getElementById("dropdown");


// Fonction qui permet au dropdown lorsque on clique sur l'image utilisateur de s'ouvrir ou de se fermer
const toggleDropdown = function () {
  //On ajoute/retire la classe show au dropdown (ce qui change son style)
  dropdownMenu.classList.toggle("show");
};

// Lorsque le bouton image utilisateur est cliqué
dropdownBtn.addEventListener("click", function (event) {
  event.stopPropagation();
  toggleDropdown();
});

// On le ferme si on clique en dehors du dropdown
document.documentElement.addEventListener("click", function (event) {
  if (dropdownMenu.classList.contains("show") && event.target != document.getElementsByClassName("divToggleDarkMode")) {
    toggleDropdown();
  }
});



//////////////////////////////////////////
//Dark Mode///////////////////////////////
//////////////////////////////////////////


body = document.querySelector("body");
darkModeBouton = document.getElementById("darkModeBouton");

//Fonction qui ajoute la classliste darkMode au body (la page en entière) ce qui change les propriétés des couleurs dans le css
function mettreDarkMode() {
  body.classList.toggle("dark-mode");
}


//On ajoute un écouteur d'événement au bouton qui permet de changer de mode
darkModeBouton.onclick = function () { mettreDarkMode(); };


//Bandeau qui peuvent s'afficher pour signifier un erreur lorsque le PHP les envoient
let bandeau1 = document.getElementById("bandeau1");
let bandeau2 = document.getElementById("bandeau2");
let btnFermer = document.getElementsByClassName("btnFermer");


//Fonction qui permet de fermer le bandeau
for (let i = 0; i < btnFermer.length; i++) {
  btnFermer[i].addEventListener("click", function (event) {
    event.currentTarget.parentElement.parentElement.style.display = "none";
  });
}









var burgerButton = document.getElementById("burgerButton");
var crossButton = document.getElementById("crossButton");
var lesCategories = document.getElementById("lesCategories");
var crossButton = document.getElementById("crossButton");
var liCategories = document.getElementsByClassName("liCategories");
var loupe = document.getElementById("loupe");
var logo = document.getElementsByClassName("logo")[0];
var formRecherche = document.getElementById("formRecherche");
var searchBar = document.getElementsByClassName("searchBar")[0];
var inputRecherche = document.getElementById("inputRecherche");




//////////////////////////////////////////
/////////////Mode Ordinateur//////////////
//////////////////////////////////////////


//////////////////////////////////////////
/////////////Mode téléphone//////////////
//////////////////////////////////////////



burgerButton.addEventListener("click", function (event) {
  event.stopPropagation();

  lesCategories.style.display = "flex";

  setTimeout(function () {
    lesCategories.style.width = "100%";

  }, 100);

  setTimeout(function () {
    for (let i = 0; i < liCategories.length; i++) {
      liCategories[i].classList.toggle("open");
    }
  }, 200);

  burgerButton.style.display = "none";
  crossButton.style.display = "block";
  document.documentElement.style.overflow = 'hidden';
});


crossButton.addEventListener("click", function (event) {
  event.stopPropagation();
  setTimeout(function () {
    for (let i = 0; i < liCategories.length; i++) {
      liCategories[i].classList.toggle("open");
    }
  });
  lesCategories.style.width = "0";
  burgerButton.style.display = "block";
  crossButton.style.display = "none";
  document.documentElement.style.overflow = 'auto';
});



formRecherche.addEventListener("click", function (event) {
  event.stopPropagation();
  logo.classList.toggle("recherche");
  loupe.classList.add("possible");
  searchBar.classList.add("active");
  formRecherche.classList.add("active");
  
});

document.documentElement.addEventListener("click", function (event) {
  if (logo.classList.contains("recherche") && event.target != document.getElementsByClassName("searchBar")) {
    logo.classList.toggle("recherche");
    loupe.classList.remove("possible");
    searchBar.classList.remove("active");
    formRecherche.classList.remove("active");
    
  }
});

window.addEventListener("resize", function (event) {
  if (window.matchMedia("(max-width: 1000px)").matches) {
    burgerButton.style.display = "block";
    crossButton.style.display = "none";
    lesCategories.style.display = "none";
    lesCategories.style.width = "0%";

  } else {
    burgerButton.style.display = "none";
    crossButton.style.display = "none";
    lesCategories.style.display = "flex";
    lesCategories.style.width = "100%";
    

  }
  for (let i = 0; i < liCategories.length; i++) {
    liCategories[i].classList.remove("open");
  }
  document.documentElement.style.overflow = 'auto';

});


//Lorsque l'on clique sur la loupe, cela active la recherche
function lancerLaRecherche() {
  inputRecherche.click();
}
loupe.addEventListener("click", lancerLaRecherche);
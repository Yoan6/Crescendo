const dropdownBtn = document.getElementById("btn");
const dropdownMenu = document.getElementById("dropdown");


// Toggle dropdown function
const toggleDropdown = function () {
  dropdownMenu.classList.toggle("show");
};

// Toggle dropdown open/close when dropdown button is clicked
dropdownBtn.addEventListener("click", function (event) {
  event.stopPropagation();
  toggleDropdown();
});

// Close dropdown when document element is clicked
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


function mettreDarkMode() {
  body.classList.toggle("dark-mode");
}

darkModeBouton.onclick = function () { mettreDarkMode(); };

let bandeau1 = document.getElementById("bandeau1");
let bandeau2 = document.getElementById("bandeau2");
let btnFermer = document.getElementsByClassName("btnFermer");

for (let i = 0; i < btnFermer.length; i++) {
  btnFermer[i].addEventListener("click", function (event) {
    event.currentTarget.parentElement.parentElement.style.display = "none";
  });
}




//////////////////////////////////////////
/////////////Mode téléphone//////////////
//////////////////////////////////////////


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
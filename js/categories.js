
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
        if (dropdownFilter[i].style.display === "flex" && toutReduit) {
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

orderBy = document.getElementById("orderBy");
orderBy.style.borderRadius = "15px";

orderBy.addEventListener("click", function (event) {
  event.stopPropagation();
  if (orderBy.style.borderRadius === "15px" || orderBy.style.borderRadius === "15px 15px 15px 15px") {
    orderBy.style.borderRadius = "15px 15px 0px 0px";
  } else {
    orderBy.style.borderRadius = "15px 15px 15px 15px";
  }
});

document.documentElement.addEventListener("click", function (event) {
  if (orderBy.style.borderRadius = "15px 15px 0px 0px") {
    orderBy.style.borderRadius = "15px 15px 15px 15px";
  }
});

/*
document.getElementsByClassName("buttonDropFilter").onclick = function() {
  var dropdownButton = document.getElementsByClassName("buttonDropFilter");
  dropdownButton.classList.toggle("menu-open");
};

*/



//whene the select is changed, we reload the page with GET parameters

var orderBy = document.getElementById("orderBy");
orderBy.addEventListener("change", function () {
  var url = new URL(window.location.href);
  if (orderBy.value) {
    //On retire les espaces
    orderBy.value = orderBy.value.replace(/\s/g, '');
    url.searchParams.set("orderByChoix", orderBy.value);
    window.location.href = url.href;
  }
});


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

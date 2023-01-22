



//On prend les éléments relatif au filtre de gauche des pages de catégories 
var dropdownButton = document.getElementsByClassName("buttonDropFilter");
var dropdownFilter = document.getElementsByClassName("filterdown");
var plus = document.getElementsByClassName("plus");
var minus = document.getElementsByClassName("minus");
const validerOuEffacer = document.getElementById("validerOuEffacer");

//Par défaut, il n'y a pas d'animation
let animationEnCours = false;

//Fonction qui permet de faire l'animation de l'ouverture et de la fermeture du filtre
const toggleDropFilter = function (numero) {
  //Si il n'y a pas d'animation en cours
  if (!animationEnCours) {
    //On retire l'écouteur d'évènement pour éviter les bugs
    dropdownButton[numero].removeEventListener("click", this, false);
    //On met l'animation en cours à true
    animationEnCours = true;

    //Si les filtres sont fermés (le plus indique que l'utilisateur peut ouvrir le filtre)
    if (plus[numero].style.display === "inline") {
      //On arrondit enlève l'arrondi du bas du bouton
      dropdownButton[numero].style.borderRadius = "15px 15px 0px 0px";

      //On rajoute un délaie pour un meilleur rendu visuel
      setTimeout(function () {
        //On indique le nouveau style que les classes doivent prendre
        dropdownFilter[numero].classList.toggle("open");
        plus[numero].style.display = "none";
        minus[numero].style.display = "inline";
        validerOuEffacer.style.maxHeight = "1000px";
        validerOuEffacer.style.visibility = "visible";
        validerOuEffacer.style.opacity = "1";
      }, 100);


    } else {
      //Si le filtre était ouvert


      //On rajoute un délaie pour un meilleur rendu visuel
      setTimeout(function () {
        //On arrondit tous les coins du bouton
        dropdownButton[numero].style.borderRadius = "15px";
      }, 700);
      //On indique le nouveau style que les classes doivent prendre
      dropdownFilter[numero].classList.toggle("open");
      plus[numero].style.display = "inline";
      minus[numero].style.display = "none";

      //on vérifie si toute les fenetres sont fermé et si c'est le cas on ferme le "ValiderOuEffacer"
      //On considère par défaut que toutes les fenetres sont fermées
      let toutReduit = true;
      for (let i = 0; i < dropdownButton.length; i++) {
        //On parcours toutes les fenetres
        if (dropdownFilter[i].classList.contains("open")) {
          //Si une fenetre est ouverte, on considère que toutes les fenetres ne sont pas fermées
          toutReduit = false;
        }
      }

      //Si toutes les fenetres sont fermés
      if (toutReduit === true) {
        //On efface le bouton "ValiderOuEffacer"
        validerOuEffacer.style.maxHeight = "0px";
        validerOuEffacer.style.visibility = "hidden";
        validerOuEffacer.style.opacity = "0";
      }
    }
  }
  //On remet le bouton à l'écoute des cliques
  dropdownButton[numero].addEventListener("click", this, false);
  //On indique que l'animation est fini
  animationEnCours = false;
}


//On indique le style que prennent à l'ouverture de la fenetre les boutons (pour que javascript sache quelles propriétés changer lors des animations)
//On parcours l'ensemble des boutons
for (let i = 0; i < dropdownButton.length; i++) {
  validerOuEffacer.style.maxHeight = "0px";
  dropdownButton[i].style.display = "flex";
  minus[i].style.display = "none";
  plus[i].style.display = "inline";
  //On ajoute un écouteur de clique sur les boutons qui declenchera l'animation
  dropdownButton[i].addEventListener("click", toggleDropFilter.bind(null, i), false);
}


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////////////
//Lorsque le select "trier par" est changé, on recharche la page avec les paramètre 
// déjà séléctionnés en query string (dans l'url)
////////////////////////////////////////////////////////////////////////
var inputOrderBy = document.getElementsByClassName("inputOrderBy");
var optionOrderByChoix = document.getElementsByClassName("optionOrderByChoix");
var orderBy = document.getElementById("orderBy");
var defaultOption = document.getElementById("defaultOption");


//on récupère les paramètres GET de l'url
const params = new Proxy(new URLSearchParams(window.location.search), {
  get: (searchParams, prop) => searchParams.get(prop),
});

if (orderBy !== null) {

  //On change la valeur par défaut du select lors de l'ouverture de la fenetre en fonction du choix effectué
  if (params.orderBy === "ASC") {
    orderBy.value = params.orderByChoix;
  } else if (params.orderBy === "DESC") {
    orderBy.value = params.orderByChoix;
    orderBy.selectedIndex = orderBy.selectedIndex + 1;
  }


  //On met une fonction d'écoute sur les changement de select
  orderBy.addEventListener("change", function () {
    //On prend l'url de la fenetre actuelle
    var url = new URL(window.location.href);
    if (orderBy.selectedIndex === 0) {
      //Si la case est par défaut, on enlève les paramètres 'trier par' de l'url
      url.searchParams.delete("orderByChoix");
      url.searchParams.delete("orderBy");
    } else {
      //Sinon on les passe à l'url 
      url.searchParams.set("orderByChoix", optionOrderByChoix[orderBy.selectedIndex - 1].value);
      url.searchParams.set("orderBy", inputOrderBy[orderBy.selectedIndex - 1].value);
    }
    //On recharge la fenetre avec le nouvelle url
    window.location.href = url.href;

  });

}




//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////
//Cette partie permet de garder les paramètres rentré dans les filtres de gauches pour les repasser à l'url
////////////////////////////////////////////////////////////////////////

//on récupère les paramètres de l'url
const parameters = new URLSearchParams(window.location.search);


//On récupère les catégories entrées dans l'url si l'on a cliqué depuis le header
var categories = parameters.getAll("choixObligatoire[categorie][]");
if (categories.length === 0) {
  //Si on a cliqué depuis le filtre de gauche
  categories = parameters.getAll("choix[categorie][]");
}
//De la meme manière on récupère les autres filtres
const styles = parameters.getAll("choix[style][]");
const taille = parameters.getAll("choix[taille][]");
const etat = parameters.getAll("choix[etat][]");


//Fonction qui permet de replacer les paramètres de l'url dans les checkboxes pour que l'utilisateur les voit cochés
function remettrelesparameters(unParametre) {
  //Pour chaques paramètres
  for (let i = 0; i < unParametre.length; i++) {
    //On récupère la checkbox correspondante
    var checkbox = document.getElementById(unParametre[i]);
    //On la coche
    checkbox.checked = true;
  }
}

//On appelle la fonction pour les différents filtres
remettrelesparameters(categories);
remettrelesparameters(styles);
remettrelesparameters(taille);
remettrelesparameters(etat);


/////////////////////////////////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////////////
//Cette partie permet de garder les paramètres lorsque on change de page par les boutons du bas de page
//Les boutons du bas de page sont des liens initialisés en php mais ne prennent pas les paramètres des filtres rentrés
////////////////////////////////////////////////////////////////////////



//On récupère les boutons du bas de page
var pageDebut = document.getElementById("pageDebut");
var pagePrecedante = document.getElementById("pagePrecedante");
var pageFin = document.getElementById("pageFin");
var pageSuivante = document.getElementById("pageSuivante");


//On créée une fonction qui permet de rajouter des paramètres à une url
function rajoutDeParametre(url, parametre, valeur) {
  url.searchParams.append(parametre, valeur);
  return url;
}

//On récupère les chiffre du bas de page (par exemple page 2, 3, 4 etc...)
//Ce sont des balises <a> donc des liens
var numeroDePage = document.getElementsByClassName("numeroDePage");

// Si la page existe bien
if (numeroDePage !== null) {
  for (let i = 0; i < numeroDePage.length; i++) {

    //On rajoute les paramètres de l'url déjà présents au lien du bas de page pour conserver les filtres
    for (let [key, value] of parameters) {
      if (key !== "page") {
        //Pour tous les paramètres de l'url sauf le paramètre page (car on veut conserver leurs numéros de page pour pouvoir naviguer)
        //On rajoute le paramètre dans le lien 
        numeroDePage[i].href = rajoutDeParametre(new URL(numeroDePage[i].href), key, value);
      }
    }
  }
}


// On rajoute les parmaètres dans les boutons du bas de page qui ne sont pas des numéros (page précédante, suivante etc...)
for (let [key, value] of parameters) {
  if (key !== "page") {
    //Pour tous les paramètres de l'url sauf le paramètre page (car on veut conserver leurs numéros de page pour pouvoir naviguer)
    pageDebut.href = rajoutDeParametre(new URL(pageDebut.href), key, value);
    pagePrecedante.href = rajoutDeParametre(new URL(pagePrecedante.href), key, value);
    pageFin.href = rajoutDeParametre(new URL(pageFin.href), key, value);
    pageSuivante.href = rajoutDeParametre(new URL(pageSuivante.href), key, value);
  }
}





//On récupère la page actuelle et on la met en bleu
const pageActuelle = document.getElementById("pageActuelle");
if (pageActuelle != null) {
  pageActuelle.style.backgroundColor = "var(--bleu)";
}


//On recupère la page maximum de la pagination
const urlPageFin = new URL(pageFin.href);
const parametreRecherchePageFin = new URLSearchParams(urlPageFin.search);
const valeurPageFin = parametreRecherchePageFin.get("page");


// On supprime les pages inutiles en fonction de la page actuelle et de la page max
if (pageActuelle.innerHTML === "1") {
  //Si la page est la première, on supprime le bouton page précédante et page début
  pageDebut.style.display = "none";
  pagePrecedante.style.display = "none";
} else if (pageActuelle.innerHTML === "2") {
  //Si la page est la deuxième on supprime la page début (inutile puisque équivalente à page précedante)
  pageDebut.style.display = "none";
}



if (pageActuelle.innerHTML === valeurPageFin || valeurPageFin === "0" || valeurPageFin === null) {
  //Si la page est la dernière, on supprime le bouton page suivante et page fin (inutile puisque équivalente à page suivante)
  //Si la page de fin n'est pas initilisé (car il n'y a pas de résultat dans la recherche)
  pageFin.style.display = "none";
  pageSuivante.style.display = "none";
}

if (parseInt(valeurPageFin) == parseInt(pageActuelle.innerHTML) + 1) {
  //On supprime la page fin si elle est juste après la page actuelle
  pageFin.style.display = "none";
}



//////////////////////////
//Tout décocher//////////
////////////////////////

//On récupère le bouton tout décocher
toutEffacer = document.getElementById("toutEffacer");
//Si il est bien initialisé (il y a des pages ou le script est appelé mais il n'y a pas les filtres à gauche)
if (toutEffacer !== null) {

  // Sélectionner toutes les checkbox de la page
  var checkboxes = document.querySelectorAll('input[type=checkbox]');

  // Boucle sur toutes les checkbox et les décocher
  toutEffacer.addEventListener("click", function () {
    for (var i = 0; i < checkboxes.length; i++) {
      checkboxes[i].checked = false;
    }
  });

}

/////////////////////////////////////////////////////////////////////////////////////////

//Si il n'y a aucun articles on affiche le message indiquant qu'il n'y en a pas
var rienAAfficher = document.getElementById("rienAAfficher");
var articles = document.getElementsByClassName("article");
if (articles.length === 0) {
  //On passe le display de la div à flex pour l'afficher (elle est en display none par défaut)
  rienAAfficher.style.display = "flex";
}



var preview = document.getElementById('preview');
var carouselImg = document.getElementsByClassName("carouselImg");
var prevBtn = document.getElementById("buttonPrev");
var nextBtn = document.getElementById("buttonNext");


//On affiche pas toutes les images du caroussel
for (let i = 0; i < carouselImg.length; i++) {
  carouselImg[i].style.display = "none";
}

//On passe la première image du carousel à la preview
preview.src = carouselImg[0].src;
//On crée un variable pour savoir à quel image on est
var currentImageIndex = 0;

//S'il y a plus d'une image
if (carouselImg.length > 1) {
  //On ajoute les fonctions sur les boutons qui permettent de passer à l'image suivante
  nextBtn.addEventListener("click", nextImage);
  prevBtn.addEventListener("click", prevImage);


  //Fonction qui permet de passer à l'image suivante
  function nextImage() {
    //On passe le compteur à l'image suivante
    currentImageIndex++;
    //On ajoute la class active au bouton pour faire un animation
    nextBtn.classList.add("active");

    if (currentImageIndex >= carouselImg.length) {
      //Si on a dépassé le nombre d'image on remet le compteur à 0 pour afficher la première
      currentImageIndex = 0;
    }
    //On affiche l'image
    preview.src = carouselImg[currentImageIndex].src;
  }


    //Fonction qui permet de passer à l'image précedante
  function prevImage() {
    //On enlève 1 à l'index
    currentImageIndex--;
    //On ajoute l'animation
    prevBtn.classList.add("active");
    if (currentImageIndex < 0) {
      //Si on est passe en dessous de 0 on affiche la dernière image
      currentImageIndex = carouselImg.length;
    }
    //On affiche l'image correspondante à l'index
    preview.src = carouselImg[currentImageIndex].src;
  }

} else {
  //S'il n'y a qu'une image on affiche pas les bouton
  prevBtn.style.display = "none";
  nextBtn.style.display = "none";
}
//On attend la fin de l'animation pour pouvoir de nouveau la faire
prevBtn.addEventListener("animationend", function () {
  //Lorsque les animation se termine on enlève la class active
  prevBtn.classList.remove("active");
});
nextBtn.addEventListener("animationend", function () {
    //Lorsque les animation se termine on enlève la class active

  nextBtn.classList.remove("active");
});



// On récupère les éléments pour le changement de prix
var formPrincipale = document.getElementById("formPrincipale");
var boutonValiderPrix = document.getElementById("boutonValiderPrix");
var popUpBackground = document.getElementsByClassName("popUpBackground")[0];
var prixEnchereProposee = document.getElementById("prixEnchereProposee");//span qui prend la valeur du prix actuel pour l'afficher dans le pop up

var spanPrixActuelText = document.getElementById("prixActuelText");

var bandeau = document.getElementsByClassName("bandeau");

//On indique au css que la propriété des bandeau est caché par défaut
for (let i = 0; i < bandeau.length; i++) {
  bandeau[i].style.display = "none";
}


var inputPrix = document.getElementById("inputPrix");

//Fonction qui permet de verifier le prix qu'a rentré l'utilisateur
function verifPrix() {

  if (parseInt(inputPrix.value) > parseInt(spanPrixActuelText.innerHTML)) {
    //Si le prix est plus grand que la dernière enchère
    //On soumet le formulaire
    formPrincipale.submit();
  } else {
    //Si il y a un prix trop bas, on affiche le pop up d'erreur 
    bandeau[1].style.display = "flex";
  }
}
if(inputPrix != null){
//On vérifie si l'utilisateur appuie sur entrée ou sur le bouton valider
inputPrix.addEventListener("keyup", function (event) {
  if (event.key === 'Enter' || event.keyCode === 13) {
    verifPrix();
  }
});

//On verifie le prix s'il appuie sur le bouton
boutonValiderPrix.addEventListener("click", function () {
  verifPrix();
});

//Si c'est le cas, un popUp s'affiche, et on active l'annulation sur le bouton 
var annulerEnchere = document.getElementById("annulerEnchere");
if(annulerEnchere != null){
  //Si le popUp est là et qu'on appuie sur annuler l'enchère
annulerEnchere.addEventListener("click", function () {
  //On fait disparaitre le pop UP
  popUpBackground.style.display = "none";
});

}
}


if(inputPrix != null){
//Au chargement de la page, on vérifie si l'enchere à été émise par l'utilisateur
var enchereOuiNon = document.getElementById("enchereOuiNon");

//S'il y a une enchère validé (passé par le php)
if (enchereOuiNon.innerHTML === "oui") {
//On affiche le bandeau indiquant que l'enchère est prise en compte
  bandeau[0].style.display = "flex";

}

}

/////////////////////


var taille = document.getElementById("taille");
var sectionTaille = document.getElementById("sectionTaille");
//Si la taille est vide (ce n'est pas un vetement)

if(taille.innerHTML == ""){
//On affiche pas la section taille
  sectionTaille.style.display = "none";

}

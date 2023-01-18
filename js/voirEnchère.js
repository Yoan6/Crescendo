


var preview = document.getElementById('preview');
var carouselImg = document.getElementsByClassName("carouselImg");
var prevBtn = document.getElementById("buttonPrev");
var nextBtn = document.getElementById("buttonNext");

for (let i = 0; i < carouselImg.length; i++) {
  carouselImg[i].style.display = "none";
}

//On passe à la preview la première image du carousel
preview.src = carouselImg[0].src;
var currentImageIndex = 0;


if (carouselImg.length > 1) {
  nextBtn.addEventListener("click", nextImage);
  prevBtn.addEventListener("click", prevImage);

  function nextImage() {
    currentImageIndex++;
    nextBtn.classList.add("active");

    if (currentImageIndex >= carouselImg.length) {
      currentImageIndex = 0;
    }
    preview.src = carouselImg[currentImageIndex].src;
  }

  function prevImage() {
    currentImageIndex--;
    prevBtn.classList.add("active");


    if (currentImageIndex < 0) {
      currentImageIndex = carouselImg.length;
    }
    preview.src = carouselImg[currentImageIndex].src;
  }

} else {
  prevBtn.style.display = "none";
  nextBtn.style.display = "none";
}
//On attend la fin de l'animation pour pouvoir de nouveau la faire
prevBtn.addEventListener("animationend", function () {
  prevBtn.classList.remove("active");
});
nextBtn.addEventListener("animationend", function () {
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

function verifPrix() {
  if (parseInt(inputPrix.value) > parseInt(spanPrixActuelText.innerHTML)) {
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

boutonValiderPrix.addEventListener("click", function () {
  verifPrix();
});

//Si c'est le cas, un popUp s'affiche, et on active l'annulation sur le bouton 
var annulerEnchere = document.getElementById("annulerEnchere");
if(annulerEnchere != null){
annulerEnchere.addEventListener("click", function () {
  popUpBackground.style.display = "none";
});

}
}


if(inputPrix != null){
//Au chargement de la page, on vérifie si l'enchere à été émise par l'utilisateur
var enchereOuiNon = document.getElementById("enchereOuiNon");

if (enchereOuiNon.innerHTML === "oui") {

  bandeau[0].style.display = "flex";

}

}

/////////////////////

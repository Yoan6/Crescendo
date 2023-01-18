
inputPrix.addEventListener("onkeypress", (event) => {
  var name = event.key;
  var code = event.code;
  return (event.charCode != 8 && event.charCode == 0 || (event.charCode >= 48 && event.charCode <= 57));
  // Alert the key name and key code on keydown
}, false);

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

prevBtn.addEventListener("animationend", function () {
  prevBtn.classList.remove("active");
});

nextBtn.addEventListener("animationend", function () {
  nextBtn.classList.remove("active");
});

var formPrincipale = document.getElementById("formPrincipale");
var boutonValiderPrix = document.getElementById("boutonValiderPrix");
var popUpBackground = document.getElementsByClassName("popUpBackground")[0];
var prixEnchereProposee = document.getElementById("prixEnchereProposee");//span qui prend la valeur du prix actuel pour l'afficher dans le pop up

var spanPrixActuelText = document.getElementById("prixActuelText");



var erreurBandeau = document.getElementsByClassName("erreurBandeau")[0];
erreurBandeau.style.display = "none";



function verifPrix() {
  if (parseInt(inputPrix.value) > parseInt(spanPrixActuelText.innerHTML)) {
   
    formPrincipale.submit();
  } else {
    erreurBandeau.style.display = "flex";
  }
}


inputPrix.addEventListener("keyup", function (event) {
  if (event.key === 'Enter' || event.keyCode === 13) {

    verifPrix();
  }
});

boutonValiderPrix.addEventListener("click", function () {

  verifPrix();

  //reportNouveauPrix.value = spanPrixActuelText.innerHTML;
  //prixEnchereProposee.innerHTML = spanPrixActuelText.innerHTML;
});


var annulerEnchere = document.getElementById("annulerEnchere");

annulerEnchere.addEventListener("click", function () {
  popUpBackground.style.display = "none";
});



/////////////////////

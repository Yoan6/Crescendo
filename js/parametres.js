const allformModif = document.getElementsByClassName("formModif");

const modifPseudo = document.getElementById("modifPseudo");
const modifMail = document.getElementById("modifMail");
const modifAdresse = document.getElementById("modifAdresse");
const modifMdp = document.getElementById("modifMdp");

const annuler = document.getElementsByClassName("annuler");
const afficherAttribut = document.getElementsByClassName("afficherAttribut");


//parametres un éléments html
const dropModif = function (btnModif) {
  // select parent element
  for (let i = 0; i < afficherAttribut.length; i++) {
    afficherAttribut[i].style.display = "flex";
  }

  const formModif = btnModif.parentElement.parentElement.getElementsByClassName("formModif")[0];
  formModif.style.display = "flex";
  btnModif.parentElement.style.display = "none";
};

const closeModif = function (btnClose) {
  for (let i = 0; i < allformModif.length; i++) {
    allformModif[i].style.display = "none";
  }
  for (let i = 0; i < afficherAttribut.length; i++) {
    afficherAttribut[i].style.display = "flex";
  }
  btnClose.parentElement.parentElement.parentElement.style.display = "flex";
};

for (let i = 0; i < annuler.length; i++) {
  annuler[i].addEventListener("click", function (event) {
    event.stopPropagation();
    this.parentElement.parentElement.parentElement.getElementsByClassName("afficherAttribut")[0].style.display = "flex";
    this.parentElement.parentElement.style.display = "none";
    for (let i = 0; i < afficherAttribut.length; i++) {
      afficherAttribut[i].style.display = "flex";
    }
  });
}

modifPseudo.addEventListener("click", function (event) {
  event.stopPropagation();

  for (let i = 0; i < allformModif.length; i++) {
    allformModif[i].style.display = "none";
  }
  dropModif(modifPseudo);
});

modifMail.addEventListener("click", function (event) {
  event.stopPropagation();
  for (let i = 0; i < allformModif.length; i++) {
    allformModif[i].style.display = "none";

  }
  dropModif(modifMail);
});

modifAdresse.addEventListener("click", function (event) {
  event.stopPropagation();
  for (let i = 0; i < allformModif.length; i++) {
    allformModif[i].style.display = "none";
  }
  dropModif(modifAdresse);
});

modifMdp.addEventListener("click", function (event) {
  event.stopPropagation();
  for (let i = 0; i < allformModif.length; i++) {
    allformModif[i].style.display = "none";

  }
  dropModif(modifMdp);
});



//PopUp modifier l'image de profil 

var modifImageProfil = document.getElementById("modifImageProfil");
var labelNouvelImage  = document.getElementById("labelNouvelImage");
var nouvelImage = document.getElementById("nouvelImage");
var carousel = document.getElementById("carousel");
var annulerChangerImage = document.getElementById("annulerChangerImage");
var popUpChangementImage = document.getElementsByClassName("divPopUp")[1];
var previsualisationImage = document.getElementById("previsualisationImage");
var nouvelleImageTopLeft = document.getElementById("nouvelleImageTopLeft");


modifImageProfil.addEventListener("click", function (event) {
  event.stopPropagation();

  popUpChangementImage.style.display = "flex";
  document.documentElement.style.overflow = 'hidden';
});

annulerChangerImage.addEventListener("click", function (event) {
  event.stopPropagation();
  nouvelleImageTopLeft.src = "";
  popUpChangementImage.style.display = "none";
  document.documentElement.style.overflow = 'auto';
  labelNouvelImage.style.display = "flex";
  carousel.style.display = "none";
  popUpChangementImage.reset();
});


labelNouvelImage.addEventListener("click", function (event) {
  event.stopPropagation();
  nouvelImage.click();
});

nouvelImage.addEventListener("change", function (event) {
    var file = this.files[0];
    if (file) {
      var reader = new FileReader();
      var self = this; // Stocker "this" pour y accéder depuis "onloadend"
      reader.onloadend = function () {
        //verify if the file is an image jpeg or png
        if (file.type == "image/jpeg" || file.type == "image/png" || file.type == "image/jpg") {
          var img = new Image();
          img.src = reader.result;
          previsualisationImage.src = img.src;
          nouvelleImageTopLeft.src = img.src;
          labelNouvelImage.style.display = "none";
            carousel.style.display = "flex";
              
        } else {
          //if the file is'nt an image, we delete the file
          self.files[0] = null;
          alert("Le fichier n'est pas une image ou n'est pas au bon format");
        }
      }
      reader.readAsDataURL(file);
    }
});









//PopUp Supprimer compte

const annulerSupprimer = document.getElementById("annulerSupprimer");

const btnSupprimerCompte = document.getElementById("btnSupprimerCompte");
const divPopUp = document.getElementsByClassName("divPopUp")[0];


btnSupprimerCompte.addEventListener("click", function (event) {
  event.stopPropagation();
  divPopUp.style.display = "flex";
  document.documentElement.style.overflowY = 'hidden';
});


annulerSupprimer.addEventListener("click", function (event) {
  event.stopPropagation();
  annulerSupprimer.parentElement.parentElement.parentElement.parentElement.style.display = "none";
  document.documentElement.style.overflowY = 'auto';
});


//PopUp suprrimer photo de profil

const annulerSupprimerPhoto = document.getElementById("annulerSupprimerPhoto");

const effacerImageProfil = document.getElementById("effacerImageProfil");
const divPopUpSupprimerPhoto = document.getElementsByClassName("divPopUp")[2];


effacerImageProfil.addEventListener("click", function (event) {
  event.stopPropagation();
  divPopUpSupprimerPhoto.style.display = "flex";
  document.documentElement.style.overflowY = 'hidden';
});


annulerSupprimerPhoto.addEventListener("click", function (event) {
  event.stopPropagation();
  divPopUpSupprimerPhoto.style.display = "none";
  document.documentElement.style.overflowY = 'auto';
});












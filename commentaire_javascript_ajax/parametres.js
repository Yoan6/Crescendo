const allformModif = document.getElementsByClassName("formModif");

const modifPseudo = document.getElementById("modifPseudo");
const modifMail = document.getElementById("modifMail");
const modifAdresse = document.getElementById("modifAdresse");
const modifMdp = document.getElementById("modifMdp");

const annuler = document.getElementsByClassName("annuler");
const afficherAttribut = document.getElementsByClassName("afficherAttribut");

//Fonction qui permet de faire apparaitre le formulaire de modification
const dropModif = function (btnModif) {
  
  for (let i = 0; i < afficherAttribut.length; i++) {
    //On affiche les attibuts du bouton sélectionné
    afficherAttribut[i].style.display = "flex";
  }
  //On récupère le form à afficher
  const formModif = btnModif.parentElement.parentElement.getElementsByClassName("formModif")[0];
  //On affiche le form
  formModif.style.display = "flex";
  //On le bouton "modifier"
  btnModif.parentElement.style.display = "none";
};


//Fonction qui permet de fermer tous les formulaire de modification
const closeModif = function (btnClose) {

  for (let i = 0; i < allformModif.length; i++) {
    //On cache les form de modif
    allformModif[i].style.display = "none";
  }

  for (let i = 0; i < afficherAttribut.length; i++) {
    //On affiche les attributs
    afficherAttribut[i].style.display = "flex";
  }
  //On réaffiche la div général
  btnClose.parentElement.parentElement.parentElement.style.display = "flex";
};


//Pour tous les boutons annuler 
for (let i = 0; i < annuler.length; i++) {
  //On leurs ajoute un écouteur d'evenement clique sur le bouton annuler
  annuler[i].addEventListener("click", function (event) {
    event.stopPropagation();
    //On réaffiche les élements du bouton en question (puisque ils ont été effacés)
    this.parentElement.parentElement.parentElement.getElementsByClassName("afficherAttribut")[0].style.display = "flex";
    this.parentElement.parentElement.style.display = "none";
    for (let i = 0; i < afficherAttribut.length; i++) {
      //On réaffiche les attributs
      afficherAttribut[i].style.display = "flex";
    }
  });
}


//Lors d'un clique sur le bouton modifier du pseudo 
modifPseudo.addEventListener("click", function (event) {
  event.stopPropagation();
//On enlève les affichage de valeurs de la div
  for (let i = 0; i < allformModif.length; i++) {
    allformModif[i].style.display = "none";
  }
  //On affiche le formulaire de modification
  dropModif(modifPseudo);
});

//Lors d'un clique sur le bouton modifier mail 

modifMail.addEventListener("click", function (event) {
  event.stopPropagation();
  
  for (let i = 0; i < allformModif.length; i++) {
    //On enlève les affichage de valeurs de la div

    allformModif[i].style.display = "none";
  }
  //On affiche le formulaire de modification

  dropModif(modifMail);
});

//Lors d'un clique sur le bouton modifier du pseudo 
modifAdresse.addEventListener("click", function (event) {
  event.stopPropagation();
  for (let i = 0; i < allformModif.length; i++) {
    //On enlève les affichage de valeurs de la div

    allformModif[i].style.display = "none";
  }
    //On affiche le formulaire de modification

  dropModif(modifAdresse);
});


//Lors d'un clique sur le bouton modifier du pseudo 

modifMdp.addEventListener("click", function (event) {
  event.stopPropagation();
  for (let i = 0; i < allformModif.length; i++) {
    //On enlève les affichage de valeurs de la div

    allformModif[i].style.display = "none";

  }
    //On affiche le formulaire de modification

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

var sauvegardImg;

//On ajoute un écouteur d'évenement sur le bouton modifier l'image de profil
modifImageProfil.addEventListener("click", function (event) {
  event.stopPropagation();

  //On sauvegarde l'ancienne image
  sauvegardImg = nouvelleImageTopLeft.src;
  //On affiche la popUp de changment d'image
  popUpChangementImage.style.display = "flex";
  //On enlève la possibilité de scroll
  document.documentElement.style.overflow = 'hidden';

});


//Si l'utisateur appuie sur le bouton annuler le changement d'image
annulerChangerImage.addEventListener("click", function (event) {
  event.stopPropagation();
  //Si l'utilisateur annule le changment d'image
  nouvelleImageTopLeft.src = sauvegardImg;
  //On enlève la popUp
  popUpChangementImage.style.display = "none";
  //On remet la possibilité de scroll
  document.documentElement.style.overflow = 'auto';
  labelNouvelImage.style.display = "flex";
  carousel.style.display = "none";
  //On reset l'afficheur d'image modifié
  popUpChangementImage.reset();
});


//Lorsque on clique sur le label ajouter image, on déclenche le input file
labelNouvelImage.addEventListener("click", function (event) {
  event.stopPropagation();
  nouvelImage.click();
});

//Lorsque l'input file recoit un fichier
nouvelImage.addEventListener("change", function (event) {
    var file = this.files[0];
    //S'il y a un fichier dans le input
    if (file) {
      //On ouvre un objet de type file reader qui peut lire les images
      var reader = new FileReader();
      //On retient self comme l'input
      var self = this; 
      //Lorsque le reader a chargé
      reader.onloadend = function () {
        //On verifie l'extension de l'image
        if (file.type == "image/jpeg" || file.type == "image/png" || file.type == "image/jpg") {
          //On crée une nouvelle image
          var img = new Image();
          img.src = reader.result;
          //on insert l'image dans la prévisualisation du popUP
          previsualisationImage.src = img.src;
          //On insert l'image dans le haut à droite de l'écran
          nouvelleImageTopLeft.src = img.src;
          //On enlève la possibilité d'ajouter une image dans le popUp
          labelNouvelImage.style.display = "none";
            carousel.style.display = "flex";
              
        } else {
          //Si le fichier n'est pas une image, on l'efface et on prévient l'utilisateur
          self.files[0] = null;
          alert("Le fichier n'est pas une image ou n'est pas au bon format");
        }
      }
      //On lis le fichier
      reader.readAsDataURL(file);
    }
});









//PopUp Supprimer compte

const annulerSupprimer = document.getElementById("annulerSupprimer");

const btnSupprimerCompte = document.getElementById("btnSupprimerCompte");
const divPopUp = document.getElementsByClassName("divPopUp")[0];

//Lorsque on clique sur le bouton surprimmer son compte
btnSupprimerCompte.addEventListener("click", function (event) {
  event.stopPropagation();
  //on affiche un popUP
  divPopUp.style.display = "flex";
  //On empeche le scroll
  document.documentElement.style.overflowY = 'hidden';
});

//Lorsque on appuie sur annuler la suprression de son compte
annulerSupprimer.addEventListener("click", function (event) {
  event.stopPropagation();
  //On ferme la popUP
  annulerSupprimer.parentElement.parentElement.parentElement.parentElement.style.display = "none";
  //On remet le scroll
  document.documentElement.style.overflowY = 'auto';
});




//PopUp suprrimer photo de profil

const annulerSupprimerPhoto = document.getElementById("annulerSupprimerPhoto");

const effacerImageProfil = document.getElementById("effacerImageProfil");
const divPopUpSupprimerPhoto = document.getElementsByClassName("divPopUp")[2];

//Lorsque on clique sur effacer l'image de profil
effacerImageProfil.addEventListener("click", function (event) {
  event.stopPropagation();
  //On affiche la popUP associé
  divPopUpSupprimerPhoto.style.display = "flex";
  //On enlève la possibilité de scroll
  document.documentElement.style.overflowY = 'hidden';
});

//Lorsque on annule la suppression de sa photo de profil
annulerSupprimerPhoto.addEventListener("click", function (event) {
  event.stopPropagation();
  //On enlève le popUp
  divPopUpSupprimerPhoto.style.display = "none";
  //On remet la possibilité de scroll
  document.documentElement.style.overflowY = 'auto';
});












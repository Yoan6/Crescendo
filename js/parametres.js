const allformModif = document.getElementsByClassName("formModif");

const modifPseudo = document.getElementById("modifPseudo");
const modifMail = document.getElementById("modifMail");
const modifAdresse = document.getElementById("modifAdresse");
const modifMdp = document.getElementById("modifMdp");

const annuler = document.getElementsByClassName("annuler");
const afficherAttribut = document.getElementsByClassName("afficherAttribut");


//parametres un éléments html
const dropModif = function(btnModif) {
  // select parent element
  for(let i = 0; i < afficherAttribut.length; i++) {
    afficherAttribut[i].style.display = "flex";
    }
    
  const formModif = btnModif.parentElement.parentElement.getElementsByClassName("formModif")[0];
  formModif.style.display = "flex";
  btnModif.parentElement.style.display = "none";
};

const closeModif = function(btnClose) {
  for (let i = 0; i < allformModif.length; i++) {
    allformModif[i].style.display = "none";
  }
  for (let i = 0; i < afficherAttribut.length; i++) {
    afficherAttribut[i].style.display = "flex";
  }
  btnClose.parentElement.parentElement.parentElement.style.display = "flex";
};

for (let i = 0; i < annuler.length; i++) {
  annuler[i].addEventListener("click", function(event) {
    event.stopPropagation();
    this.parentElement.parentElement.parentElement.getElementsByClassName("afficherAttribut")[0].style.display = "flex";
    this.parentElement.parentElement.style.display = "none";
    for(let i = 0; i < afficherAttribut.length; i++) {
      afficherAttribut[i].style.display = "flex";
    }
  });
}

modifPseudo.addEventListener("click", function(event) {
  event.stopPropagation();

    for (let i = 0; i < allformModif.length; i++) {
        allformModif[i].style.display = "none";
    }
  dropModif(modifPseudo);
});

modifMail.addEventListener("click", function(event) {
  event.stopPropagation();
  for (let i = 0; i < allformModif.length; i++) {
    allformModif[i].style.display = "none";

  }
  dropModif(modifMail);
});

modifAdresse.addEventListener("click", function(event) {
  event.stopPropagation();
  for (let i = 0; i < allformModif.length; i++) {
    allformModif[i].style.display = "none";
  }
  dropModif(modifAdresse);
});

modifMdp.addEventListener("click", function(event) {
  event.stopPropagation();
  for (let i = 0; i < allformModif.length; i++) {
    allformModif[i].style.display = "none";
    
  }
  dropModif(modifMdp);
});


//PopUp Supprimer Compte
const annulerSupprimer = document.getElementById("annulerSupprimer");

const btnSupprimerCompte = document.getElementById("btnSupprimerCompte");
const divPopUp = document.getElementsByClassName("divPopUp")[0];


btnSupprimerCompte.addEventListener("click", function(event) {
  event.stopPropagation();
  divPopUp.style.display = "flex";
  document.documentElement.style.overflow = 'hidden';
  });


annulerSupprimer.addEventListener("click", function(event) {
event.stopPropagation();
annulerSupprimer.parentElement.parentElement.parentElement.parentElement.style.display = "none";
document.documentElement.style.overflow = 'auto';

});

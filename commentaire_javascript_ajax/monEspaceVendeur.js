





var article = document.getElementsByClassName("article");
var divSupprimer = document.getElementsByClassName("divSupprimer");
var numArticle = document.getElementsByClassName("numArticle");


var annulerSupprimer = document.getElementById("annulerSupprimer");
var idArticleAsupprimer = document.getElementById("idArticleAsupprimer");
var btnSupprimerCompte = document.getElementById("btnSupprimerCompte");
var divPopUp = document.getElementsByClassName("divPopUp")[0];

//Pour chaque article, on ajoute un eventListener sur le bouton supprimer article (le bouton rouge à droite)
for (let i = 0; i < divSupprimer.length; i++) {
    //On ajoute un eventListener sur le bouton supprimer article
    divSupprimer[i].addEventListener("click", function(event) {
        event.stopPropagation();
        //On recupère l'id de l'article (passé dans un élément caché)
        let idArticle = numArticle[i].value;
        //On met l'id de l'article dans un input caché
        idArticleAsupprimer.setAttribute('value', idArticle);
        //On affiche la popUp qui prévient que l'article va être supprimé
        divPopUp.style.display = "flex";
        document.documentElement.style.overflow = 'hidden';
    });
    
}

//On ajoute un eventListener sur le bouton qui annule la suppression du compte
annulerSupprimer.addEventListener("click", function(event) {
    event.stopPropagation();
    //On cache la popUp
    divPopUp.style.display = "none";
    document.documentElement.style.overflow = 'auto';

});



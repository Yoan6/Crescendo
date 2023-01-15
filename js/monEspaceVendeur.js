





var article = document.getElementsByClassName("article");
var divSupprimer = document.getElementsByClassName("divSupprimer");
var numArticle = document.getElementsByClassName("numArticle");


var annulerSupprimer = document.getElementById("annulerSupprimer");
var idArticleAsupprimer = document.getElementById("idArticleAsupprimer");
var btnSupprimerCompte = document.getElementById("btnSupprimerCompte");
var divPopUp = document.getElementsByClassName("divPopUp")[0];



for (let i = 0; i < divSupprimer.length; i++) {
    divSupprimer[i].addEventListener("click", function(event) {
        event.stopPropagation();
        let idArticle = numArticle[i].value;
        idArticleAsupprimer.setAttribute('value', idArticle);
        divPopUp.style.display = "flex";
        document.documentElement.style.overflow = 'hidden';
        

    });
    
}

annulerSupprimer.addEventListener("click", function(event) {
    event.stopPropagation();
    divPopUp.style.display = "none";
    document.documentElement.style.overflow = 'auto';

});



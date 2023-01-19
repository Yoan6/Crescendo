
//var tester = document.getElementById("testAEnlever");



var lesEncheres = document.getElementsByClassName("numEnchereRecupererValeur");
var listeUsers = document.getElementsByClassName("numUtilisateurRecupererValeur");

if (listeUsers !== 0) {


    numUtilisateur = listeUsers[0].value

    /**
     * récupérer toutes les articles pour les actualiser en récupérant les bons numéros
     * 
     */


    var estlike = document.getElementsByClassName('estlike');



    var likeActuelText = document.getElementsByClassName("likeActuelText"); // C'est l'endroit pour le nombre de like 
    var likeBouton = document.getElementsByClassName("likeBouton"); // Le bouton like 
    var dislikeBouton = document.getElementsByClassName("dislikeBouton"); // Le bouton dislike
    for (let i = 0; i < lesEncheres.length; i++) { // Le numéro d'enchère à été mis avec la classe de l'objet
        // Données
        let numEnchere = lesEncheres[i].value;

        if (estlike[i].innerHTML == '1') {
            likeBouton[i].classList.add("liked");
        } else if (estlike[i].innerHTML == '0') {
            dislikeBouton[i].classList.add("disliked");
        }
        // Events

        window.addEventListener("load", getLikeActuel(numEnchere, likeActuelText[i]));

        likeBouton[i].addEventListener("click", function () { setLike(numEnchere, numUtilisateur, 1, i); });
        dislikeBouton[i].addEventListener("click", function () { setLike(numEnchere, numUtilisateur, 0, i); });
        setInterval(getLikeActuel(numEnchere, likeActuelText[i]), 600);  // 1000 ms = 1s, note ne pas mettre les parenthèses on parle de la fonction

    }




    /**
     * Changer le compteur 
     * @param {*} numEnchere 
     * @param {*} likeActuelText 
     */
    function getLikeActuel(numEnchere, likeActuelText) {
        // Créer l'objet XMLHttpRequest
        var xmlhttp = new XMLHttpRequest();

        // Quand le serveur est prêt, changer le texte du nombre de likes de la vue
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                likeActuelText.innerHTML = this.responseText;
            }
        }

        // Demander le fichier avec la fonction à exécuter
        xmlhttp.open("GET", "../ajax/getLikeActuel.php?numEnchere=" + numEnchere);
        xmlhttp.send();
    }


    /**
     * Mettre un like ou un dislike
     * @param {*} numEnchere 
     * @param {*} numUtilisateur 
     * @param {*} estLike 1 = true et 0 = false
     */
    function setLike(numEnchere, numUtilisateur, estLike, i) {
        // Créer l'objet XMLHttpRequest
        var xmlhttp = new XMLHttpRequest();

        // Quand le serveur est prêt, changer le texte du nombre de likes de la vue
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                // Faire le changement en css
                //tester.innerHTML = this.responseText;

                getLikeActuel(numEnchere, likeActuelText[i]);

                if (likeBouton[i].classList.contains("liked") && estLike == 1) {
                    likeBouton[i].classList.remove("liked");
                } else if (dislikeBouton[i].classList.contains("disliked") && estLike == 0) {
                    dislikeBouton[i].classList.remove("disliked");
                } else if (estLike == 1) {
                    likeBouton[i].classList.add("liked");
                    dislikeBouton[i].classList.remove("disliked");
                } else if (estLike == 0) {
                    dislikeBouton[i].classList.add("disliked");
                    likeBouton[i].classList.remove("liked");
                }
            }
        }

        // Demander le fichier avec la fonction à exécuter
        xmlhttp.open("GET", "../ajax/setLike.php?numEnchere=" + numEnchere + "&numUtilisateur=" + numUtilisateur + "&estLike=" + estLike);
        xmlhttp.send();
    }



}
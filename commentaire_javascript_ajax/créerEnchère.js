// Par défaut, on cache le carousel
var carousel = document.getElementById("carousel").style.display = "none";
// Une liste qui stock les images que l'utilisateur va ajouter
var images = [];
//Un booleen qui nous permet de savoir si l'utilisateur a au moins une image
var aumoinsUneImage = false;



//On récupère les inputs de type file et le label ajout ("Ajouter une image")
var inputImage = document.getElementById("btnImage");
var inputImage2 = document.getElementById("btnImage2");
var inputImage3 = document.getElementById("btnImage3");
var labelAjout = document.getElementById("labelAjout");

//on met un event listener sur le premier input de type file
inputImage.addEventListener("change", uploadImage);
//on met un event listener sur le deuxième input de type file
inputImage2.addEventListener("change", uploadImage);
//on met un event listener sur le troisième input de type file
inputImage3.addEventListener("change", uploadImage);


//Si le label ajout existe 
if (labelAjout) {

  //On ajoute un event listener sur le label ajout
  labelAjout.addEventListener("click", function () {
    //S'il n'y a pas d'image, on clique sur le premier input de type file
    if (images.length == 0) {
      inputImage.click();
    } else if (images.length == 1) {
      //S'il y a une image, on clique sur le deuxième input de type file
      inputImage2.click();
    } else if (images.length == 2) {
      //S'il y a deux images, on clique sur le troisième input de type file
      inputImage3.click();
    }
  });

}



//Fonction déclenchée lorsque on appuie sur le label ajout et donc sur un input file
function uploadImage() {
  //Si moins de 3 images sont ajoutées on execute la fonction
  if (images.length < 3) {
    //On recupère le fichier rentré par l'utilisateur
    var file = this.files[0];
    if (file) {
      //S'il y a un fichier

      //On ouvre un objet de type reader (qui permet de lire les fichiers images)
      var reader = new FileReader();
      // Stocker "this" pour y accéder depuis "onloadend"
      var self = this;
      //Lors que le reader a fini de lire le fichier
      reader.onloadend = function () {
        //On vérifie si le type du fichier est bon
        if (file.type == "image/jpeg" || file.type == "image/png" || file.type == "image/jpg") {
          //On créé un objet image
          var img = new Image();
          //On lui donne le src du fichier
          img.src = reader.result;
          //On ajoute l'image à la liste des images
          images.push(img);
          //On affiche l'image actuelle sur le caroussel
          document.getElementById("current-image").src = img.src;

          //On affiche le caroussel (car par défaut, il est caché)
          carousel.style.display = "flex";
          //On ajoute le style "active" au label (pour le rétrecir et permettre de voir le carousel)
          labelAjout.classList.add("active");
          if (images.length == 1) {
            //S'il n'y a qu'une image, on cache les boutons 
            prevBtn.style.display = "none";
            nextBtn.style.display = "none";
          } else {
            //Sinon on les montre
            prevBtn.style.display = "block";
            nextBtn.style.display = "block";
          }

          if (images.length == 3) {
            //Lorsque l'utilisateur a upload 3 images, on cache le label ajout (il ne peut plus en ajouter)
            labelAjout.style.display = "none";
          }

        } else {
          //Si le fichier n'est pas une image, on remet le input à null
          self.files[images.length] = null;
          //On alerte l'utilisateur que le fichier n'est pas une image
          alert("Le fichier n'est pas une image ou n'est pas au bon format");
        }
      }
      //On lit le fichier
      reader.readAsDataURL(file);
    }
  }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//previsualisation de l'image
//////////////////////////////////

//On récupère les éléments du carousel
var carousel = document.getElementById("carousel");
var prevBtn = document.getElementById("buttonPrev");
var nextBtn = document.getElementById("buttonNext");
var currentImage = document.getElementById("current-image");
var currentImageIndex = images.length - 1;


// Fonctions pour la navigation entre les images
function prevImage() {
  //On décrémente l'index de l'image actuelle
  currentImageIndex--;
  if (currentImageIndex < 0) {
  //Si l'index est inférieur à 0, on le remet à la dernière image
    currentImageIndex = images.length - 1;
  }
  //On change l'image actuelle
  currentImage.src = images[currentImageIndex].src;
}

function nextImage() {
  //On incrémente l'index de l'image actuelle
  currentImageIndex++;
  if (currentImageIndex >= images.length) {
  //Si l'index est supérieur ou égal au nombre d'images, on le remet à 0
    currentImageIndex = 0;
  }
  //On change l'image actuelle
  currentImage.src = images[currentImageIndex].src;
}


//On ajoute les event listeners sur les boutons
prevBtn.addEventListener("click", prevImage);
nextBtn.addEventListener("click", nextImage);


//////////////////////////////////////////////////////////////////////////////////


//On récupère la catégorie et la taille dans les select
var categories = document.getElementById("categorie");
var taille = document.getElementById("taille");// div de la taille


//On cache la div de la taille par défaut
taille.style.display = "none";


//Lorsque on change la catégorie de l'objet
categories.addEventListener("change", function () {
  //Si la catégorie est "Vêtement"
  if (categories.value == "Vêtement") {
    //On affiche la div de la Taille
    taille.style.display = "flex";
    //Elle est requise pour mettre l'enchère en ligne
    taille.setAttribute("required", "");
  } else {
    //Sinon on efface la div de la taille
    taille.style.display = "none";
    //Elle n'est pas obligatoire
    taille.removeAttribute("required");

  }
});




//On récupère les éléments de la date
var dateEnchere = document.getElementById("dateEnchere");
//On déploie l'enchere lorsque on clique sur l'input et pas sur la petite icone
dateEnchere.addEventListener("click", function () {
  dateEnchere.showPicker();
});
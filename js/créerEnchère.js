var currentImageIndex = 0; // counter to keep track of the current image
var carousel = document.getElementById("carousel").style.display = "none";
// Array to store the uploaded images
var images = [];
var aumoinsUneImage = false;

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

labelAjout.addEventListener("click", function () {
  if (images.length == 0) {
    inputImage.click();
  } else if (images.length == 1) {
    inputImage2.click();
  } else if (images.length == 2) {
    inputImage3.click();
  }
});


function uploadImage() {
  if (images.length < 3) {
    var file = this.files[0];
    if (file) {
      var reader = new FileReader();
      var self = this; // Stocker "this" pour y accéder depuis "onloadend"
      reader.onloadend = function () {
        //verify if the file is an image jpeg or png
        if (file.type == "image/jpeg" || file.type == "image/png" || file.type == "image/jpg") {
          var img = new Image();
          img.src = reader.result;
          images.push(img); // add the new image to the array
          document.getElementById("current-image").src = img.src;
          
            carousel.style.display = "inline";
            labelAjout.style.position = "absolute";
            labelAjout.style.bottom = "30px";
            labelAjout.style.backgroundColor = "white";
            labelAjout.style.height = "20%";
            labelAjout.style.width = "50%";

            if(images.length == 3){
              labelAjout.style.display = "none";
              }
              
        } else {
          //if the file is'nt an image, we delete the file
          self.files[images.length] = null;
          alert("Le fichier n'est pas une image ou n'est pas au bon format");
        }
      }
      reader.readAsDataURL(file);
    }
  }
}


//previsualisation de l'image


var carousel = document.getElementById("carousel");
var prevBtn = document.getElementById("buttonPrev");
var nextBtn = document.getElementById("buttonNext");
var currentImage = document.getElementById("current-image");

// Functions
function prevImage() {
  currentImageIndex--;
  if (currentImageIndex < 0) {
    currentImageIndex = images.length - 1;
  }
  currentImage.src = images[currentImageIndex].src;
}

function nextImage() {
  currentImageIndex++;
  if (currentImageIndex >= images.length) {
    currentImageIndex = 0;
  }
  currentImage.src = images[currentImageIndex].src;
}

prevBtn.addEventListener("click", prevImage);
nextBtn.addEventListener("click", nextImage);

var currentImageIndex = 0; // counter to keep track of the current image
var carousel = document.getElementById("carousel").style.display = "none";
// Array to store the uploaded images
var images = [];
var labelAjout = document.getElementById("labelAjout");
document.getElementById("btnImage").addEventListener("change", function() {
  var file = this.files[0];
  var reader = new FileReader();
  reader.onloadend = function() {
    var img = new Image();
    img.src = reader.result;
    images.push(img); // add the new image to the array
    if (currentImageIndex === 0) {
      document.getElementById("current-image").src = img.src;
    }
  }
  if (file) {
    reader.readAsDataURL(file);
    carousel.style.display = "inline";
    labelAjout.style.position = "absolute";
    labelAjout.style.bottom = "0px";
    labelAjout.style.backgroundColor = "white";
    labelAjout.style.height = "50%";

  }
});

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

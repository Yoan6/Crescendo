const prix = document.getElementById('prix');

prix.addEventListener("onkeypress", (event) => {
    var name = event.key;
    var code = event.code;
    return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57));
    // Alert the key name and key code on keydown
  }, false);

  
  var carouselImg = document.getElementsByClassName("carouselImg");
  var currentImage = document.getElementById("premiereImage");
  var currentImageIndex = 0;
  var prevBtn = document.getElementById("buttonPrev");
  var nextBtn = document.getElementById("buttonNext");

  if(carouselImg.length > 1){
  nextBtn.addEventListener("click", nextImage);
  prevBtn.addEventListener("click", prevImage);

  function nextImage() {
    currentImageIndex++;
    if (currentImageIndex >= carouselImg.length) {
      currentImageIndex = 0;
    }
    currentImage.src = carouselImg[currentImageIndex].src;
  }

  function prevImage() {
    currentImageIndex--;
    if (currentImageIndex < 0) {
      currentImageIndex = carouselImg.length - 1;
    }
    currentImage.src = carouselImg[currentImageIndex].src;
  }

} else {
  prevBtn.style.display = "none";
  nextBtn.style.display = "none";
}
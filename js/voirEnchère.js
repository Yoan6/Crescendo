const prix = document.getElementById('prix');

prix.addEventListener("onkeypress", (event) => {
    var name = event.key;
    var code = event.code;
    return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57));
    // Alert the key name and key code on keydown
  }, false);

  
  var carouselImg = document.getElementsByClassName("carouselImg");
  var currentImageIndex = 0;
  var currentImage = carouselImg[currentImageIndex];
  var prevBtn = document.getElementById("buttonPrev");
  var nextBtn = document.getElementById("buttonNext");

for(let i = 1; i < carouselImg.length; i++){
  carouselImg[i].style.display = "none";
}

currentImage.src = carouselImg[1].src;


  if(carouselImg.length > 1){
  nextBtn.addEventListener("click", nextImage);
  prevBtn.addEventListener("click", prevImage);

  function nextImage() {
    currentImageIndex++;
    if (currentImageIndex >= carouselImg.length) {
      currentImageIndex = 1;
    }
    currentImage.src = carouselImg[currentImageIndex].src;
  }

  function prevImage() {
    currentImageIndex--;
    if (currentImageIndex < 0) {
      currentImageIndex = carouselImg.length;
    }
    currentImage.src = carouselImg[currentImageIndex].src;
  }

} else {
  prevBtn.style.display = "none";
  nextBtn.style.display = "none";
}
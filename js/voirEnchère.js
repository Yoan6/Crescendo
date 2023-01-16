const prix = document.getElementById('prix');

prix.addEventListener("onkeypress", (event) => {
    var name = event.key;
    var code = event.code;
    return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57));
    // Alert the key name and key code on keydown
  }, false);

  var preview = document.getElementById('preview');
  var carouselImg = document.getElementsByClassName("carouselImg");
  var currentImageIndex = 0;
  var currentImage = carouselImg[currentImageIndex];
  var prevBtn = document.getElementById("buttonPrev");
  var nextBtn = document.getElementById("buttonNext");

for(let i = 0; i < carouselImg.length; i++){
  carouselImg[i].style.display = "none";
}

preview.src = carouselImg[0].src;


  if(carouselImg.length > 1){
  nextBtn.addEventListener("click", nextImage);
  prevBtn.addEventListener("click", prevImage);

  function nextImage() {
    currentImageIndex++;
    if (currentImageIndex >= carouselImg.length) {
      currentImageIndex = 1;
    }
    preview.src = carouselImg[currentImageIndex].src;
  }

  function prevImage() {
    currentImageIndex--;
    if (currentImageIndex < 0) {
      currentImageIndex = carouselImg.length;
    }
    preview.src = carouselImg[currentImageIndex].src;
  }

} else {
  prevBtn.style.display = "none";
  nextBtn.style.display = "none";
}
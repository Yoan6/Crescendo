const like = document.getElementsByClassName('like');
const dislike = document.getElementsByClassName('dislikePath');
const heart = document.getElementsByClassName('heartPath');

for(let i = 0; i < like.length; i++) {
  like[i].style.fill = "transparent";
  dislike[i].style.fill = "transparent";
  heart[i].style.fill = "transparent";

  like[i].addEventListener('click', function(event) {
    event.stopPropagation();
    if(like[i].style.fill === "transparent") {
        like[i].style.fill = "var(--bleu)";
        like[i].style.transition = "fill 0.2s";
        like[i].style.stroke = "var(--bleu)";
        dislike[i].style.fill = "transparent";
        dislike[i].style.stroke = "white";
    } else {
        like[i].style.fill = "transparent";
        like[i].style.stroke = "white";
    }
});



//same function for dislike
dislike[i].addEventListener('click', function(event) {
    event.stopPropagation();
    if(dislike[i].style.fill === "transparent") {
        dislike[i].style.fill = "var(--rouge)";
        dislike[i].style.transition = "fill 0.2s";
        dislike[i].style.stroke = "var(--rouge)";
        like[i].style.fill = "transparent";
        like[i].style.stroke = "white";

    } else {
        dislike[i].style.fill = "transparent";
        dislike[i].style.stroke = "white";
    }
});



//heart animation
heart[i].addEventListener('click', function(event) {
    event.stopPropagation();
    if(heart[i].style.fill === "transparent") {
        heart[i].style.fill = "var(--rouge)";
        heart[i].style.transition = "fill 0.5s";
        heart[i].style.stroke = "var(--rouge)";
    } else {
        heart[i].style.fill = "transparent";
        heart[i].style.stroke = "white";
    }
});

}
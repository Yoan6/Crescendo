const likesElement = document.getElementsByClassName('like');



for (let i = 0; i < likesElement.length; i++) {

 

    let like = document.getElementsByClassName('likePath')[i];
    let dislike = document.getElementsByClassName('dislikePath')[i];
    let heart = document.getElementsByClassName('heartPath')[i];

    like.style.fill = "transparent";
    dislike.style.fill = "transparent";
    heart.style.fill = "transparent";


    let inputLike = document.getElementsByClassName('inputLike')[i];
    let inputDislike = document.getElementsByClassName('inputDislike')[i];
    let inputHeart = document.getElementsByClassName('inputHeart')[i];




    like.addEventListener('click', function (event) {
        event.stopPropagation();
        if (like.style.fill === "transparent") {
            like.style.fill = "var(--bleu)";
            like.style.transition = "fill 0.2s";
            like.style.stroke = "var(--bleu)";
            dislike.style.fill = "transparent";
            dislike.style.stroke = "white";
        } else {
            like.style.fill = "transparent";
            like.style.stroke = "white";
        }
    });



    //same function for dislike
    dislike.addEventListener('click', function (event) {
        event.stopPropagation();
        if (dislike.style.fill === "transparent") {
            dislike.style.fill = "var(--rouge)";
            dislike.style.transition = "fill 0.2s";
            dislike.style.stroke = "var(--rouge)";
            like.style.fill = "transparent";
            like.style.stroke = "white";

        } else {
            dislike.style.fill = "transparent";
            dislike.style.stroke = "white";
        }
    });



    //heart animation
    heart[i].addEventListener('click', function (event) {
        event.stopPropagation();
        if (heart.style.fill === "transparent") {
            heart.style.fill = "var(--rouge)";
            heart.style.transition = "fill 0.5s";
            heart.style.stroke = "var(--rouge)";
        } else {
            heart.style.fill = "transparent";
            heart.style.stroke = "white";
        }
    });

}





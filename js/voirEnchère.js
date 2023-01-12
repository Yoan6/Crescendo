const prix = document.getElementById('prix');

prix.addEventListener("onkeypress", (event) => {
    var name = event.key;
    var code = event.code;
    return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57));
    // Alert the key name and key code on keydown
  }, false);

  
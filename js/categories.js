
const dropdownButton = document.getElementById("buttonDropFilter");
const dropdownFilter = document.getElementById("filterdown");
const plus = document.getElementById("plus");
const minus = document.getElementById("minus");
const validerOuEffacer = document.getElementById("validerOuEffacer");


// Toggle dropdown function
const toggleDropFilter = function() {
    dropdownFilter.style.display = dropdownFilter.style.display != "flex" ? "flex" : "none";
    if(dropdownFilter.style.display == "flex") {
        plus.style.display = "none";
        minus.style.display = "inline";
        validerOuEffacer.style.display = "flex";
    } else {
        plus.style.display = "inline";
        minus.style.display = "none";
        validerOuEffacer.style.display = "none";

    }
};

// Toggle dropdown open/close when dropdown button is clicked
dropdownButton.addEventListener("click", function(event) {
  event.stopPropagation();
  toggleDropFilter();
});


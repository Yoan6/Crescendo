const dropdownBtn = document.getElementById("btn");
const dropdownMenu = document.getElementById("dropdown");


// Toggle dropdown function
const toggleDropdown = function () {
  dropdownMenu.classList.toggle("show");
};

// Toggle dropdown open/close when dropdown button is clicked
dropdownBtn.addEventListener("click", function (event) {
  event.stopPropagation();
  toggleDropdown();
});

// Close dropdown when document element is clicked
document.documentElement.addEventListener("click", function (event) {
  if (dropdownMenu.classList.contains("show") && event.target != document.getElementsByClassName("divToggleDarkMode")) {
    toggleDropdown();
  }
});



//////////////////////////////////////////
//Dark Mode///////////////////////////////
//////////////////////////////////////////
body = document.querySelector("body");
darkModeBouton = document.getElementById("darkModeBouton");
		
					
function mettreDarkMode() {
	body.classList.toggle("dark-mode");
}

darkModeBouton.onclick =  function() {mettreDarkMode();};

let bandeau1 = document.getElementById("bandeau1");
let bandeau2 = document.getElementById("bandeau2");
let btnFermer = document.getElementsByClassName("btnFermer");

for (let i = 0; i < btnFermer.length; i++) {
  btnFermer[i].addEventListener("click", function(event){
    event.currentTarget.parentElement.parentElement.style.display = "none";
  });
}

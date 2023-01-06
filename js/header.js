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

// Close dropdown when dom element is clicked
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






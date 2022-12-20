body = document.querySelector("body");
darkModeBouton = document.querySelector("button");
		
					
function mettreDarkMode() {
	body.classList.toggle("dark-mode");
}

darkModeBouton.onclick =  function() {mettreDarkMode();};
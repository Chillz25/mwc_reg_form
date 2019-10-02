
document.getElementById("contact").addEventListener("keydown", function(e) {
    if(e.keyCode !== 8 && (e.keyCode < 48 || e.keyCode > 57)){
    	e.preventDefault(); // refuse input if the key inputted is not either a number or the BACKSPACE key
    }
});

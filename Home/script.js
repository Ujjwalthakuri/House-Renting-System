// Login dropdown menu
// console.log("JavaScript is working!");

var log_option = document.getElementsByClassName("login")[0]; // Select the first .login element
var log_menu = document.getElementsByClassName("login-drop-down")[0]; // Select the first .login-drop-down element

log_option.addEventListener("click", function() {
    // Toggle the display of the dropdown menu
    if (log_menu.style.display === "block") {
        log_menu.style.display = "none"; 
    } else {
        log_menu.style.display = "block"; 
    }
});


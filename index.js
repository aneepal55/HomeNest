window.addEventListener("scroll", function () {
    var header = document.getElementById("header");
    if (window.scrollY > 0) {
        header.style.transform = "translateY(-100%)";
    } else {
        header.style.transform = "translateY(0)";
    }
});

window.addEventListener("scroll", function () {
    var footer = document.getElementById("footer");
    // Check if user has scrolled to the bottom of the page
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
        footer.classList.add("show-footer"); // Add class to show footer
    } else {
        footer.classList.remove("show-footer"); // Remove class to hide footer
    }
});

document.getElementById('loginLink').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor click behavior
    const currentUrl = window.location.href.split('#')[0]; // Remove existing hash if there is one
    window.location.href = currentUrl + '#login-popup'; // Append the new hash
});

document.getElementById('signupLink').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor click behavior
    const currentUrl = window.location.href.split('#')[0]; // Remove existing hash if there is one
    window.location.href = currentUrl + '#signup-popup'; // Append the new hash
});
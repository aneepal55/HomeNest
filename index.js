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
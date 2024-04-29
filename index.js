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
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
        footer.classList.add("show-footer");
    } else {
        footer.classList.remove("show-footer");
    }
});

document.getElementById('loginLink').addEventListener('click', function(event) {
    event.preventDefault();
    const currentUrl = window.location.href.split('#')[0];
    window.location.href = currentUrl + '#login-popup';
});

document.getElementById('signupLink').addEventListener('click', function(event) {
    event.preventDefault();
    const currentUrl = window.location.href.split('#')[0];
    window.location.href = currentUrl + '#signup-popup';
});
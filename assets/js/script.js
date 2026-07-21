document.addEventListener("DOMContentLoaded", function() {
    var toggleBtn = document.getElementById("menu-toggle");
    if (toggleBtn) {
        toggleBtn.addEventListener("click", function(e) {
            e.preventDefault();
            document.body.classList.toggle("sb-sidenav-toggled");
        });
    }
});
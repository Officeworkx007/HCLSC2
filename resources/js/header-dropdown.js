document.addEventListener("DOMContentLoaded", function () {
    const btn = document.getElementById("apply-btn");
    const menu = document.getElementById("dropdown");

    if (!btn || !menu) return;

    btn.addEventListener("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        menu.classList.toggle("hidden");
    });

    document.addEventListener("click", function (event) {
        if (!btn.contains(event.target) && !menu.contains(event.target)) {
            menu.classList.add("hidden");
        }
    });
});

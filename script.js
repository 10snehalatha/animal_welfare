// script.js
document.addEventListener("DOMContentLoaded", function () {
    const readMoreBtns = document.querySelectorAll(".read-more-btn");
    readMoreBtns.forEach(btn => {
        btn.addEventListener("click", function () {
            const card = this.closest(".card");
            card.classList.toggle("read-more-active");
        });
    });
});

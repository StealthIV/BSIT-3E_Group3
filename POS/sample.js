document.addEventListener("DOMContentLoaded", function() {
    var dropdownBtns = document.querySelectorAll(".dropdown-btn");

    dropdownBtns.forEach(function(btn) {
        btn.addEventListener("click", function() {
            var dropdownContainer = this.nextElementSibling;
            dropdownContainer.classList.toggle("active");
            this.classList.toggle("active");
        });
    });
});

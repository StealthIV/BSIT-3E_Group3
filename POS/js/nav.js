document.querySelector('.dropdown-btn').addEventListener('click', function (e) {
    e.preventDefault();
    var dropdown = this.parentNode;
    dropdown.classList.toggle('active');
});
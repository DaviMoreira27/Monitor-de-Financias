const h4Rows = document.querySelectorAll('.row-info h4');

h4Rows.forEach(el => {
    if (el.innerHTML >= 0) {
        el.style.color = '#00C947';
    } else {
        el.style.color = '#FA5E4E';
    }
})
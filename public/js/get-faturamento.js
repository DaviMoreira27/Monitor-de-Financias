
const h4Rows = document.querySelectorAll('.row-info h4');

h4Rows.forEach(el => {
    let valueReplace = parseFloat(el.innerHTML.replace('R$', '').replace(',', '.'));

    if (valueReplace >= 0.00) {
        el.style.color = '#00C947';
    } else {
        el.style.color = '#FA5E4E';
    }
})
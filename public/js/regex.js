const masks = {
    cpf(value) {
        return value
            .replace(/\D/g, "")
            .replace(/(\d{2})(\d)/, "$1.$2")
            .replace(/(\d{3})(\d)/, "$1.$2")
            .replace(/(\d{3})(\d)/, "$1-$2")
            .replace(
                /(\d{2}).(\d)(\d{2}).(\d)(\d{2})-(\d)(\d)/,
                "$1$2.$3$4.$5$6-$7"
            )
            .replace(/(-\d{2})\d+?$/, "$1");
    },
    month(value) {
        return value
            .replace(/\D/g, "")
            .replace(/(\d{2})(\d{4})/, "$1/$2")
    },

    number(value) {
        return value
            .replace(/\D/g, "");
    },
    
    money(value) {
        return value
            .replace(/\D/g, "")
            .replace(/([0-9]{2})$/g, ".$1")
    },


};

document.querySelectorAll('input').forEach(($input) => {
    const field = $input.dataset.js;
    $input.addEventListener('input', (e) => {
        e.target.value = masks[field](e.target.value);
    }, false);
});
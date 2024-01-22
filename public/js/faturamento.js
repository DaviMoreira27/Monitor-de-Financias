const selectTipoGasto = document.getElementById('select-tipoGasto');
const inputValorGasto = document.getElementById('input-valorGasto');
const buttoAddGasto = document.getElementById('add-gasto');
const divObjGastos = document.getElementById('rowObj-gastos');
const collectionInput = document.getElementById('inputCollectGastos');
const formPost = document.querySelector('form');

function isEmpty(str) {
    return !str.trim().length;
}

let collectionGasto = []

if(localStorage.getItem('gastos')){
    collectionGasto = JSON.parse(localStorage.getItem('gastos'));
}


//TODO: Refatorar em uma classe

buttoAddGasto.addEventListener('click', () => {
    if (!isEmpty(selectTipoGasto.value) && !isEmpty(inputValorGasto.value)) {
        let gastoObj = {
            tipoGasto: selectTipoGasto.value,
            nomeGasto: selectTipoGasto.options[selectTipoGasto.selectedIndex].text,
            valorGasto: inputValorGasto.value,
        };

        collectionGasto.push(gastoObj);
        localStorage.setItem('gastos', JSON.stringify(collectionGasto));

        gastoObj = {}
        inputValorGasto.value = '';

        let divObj = document.createElement('div');
        let titleDivObj = document.createElement('p');
        let buttonObj = document.createElement('button');
        buttonObj.setAttribute('type', 'button');
        buttonObj.setAttribute('id', 'closeObjButton');

        let closeIcon = document.createElement('i');
        closeIcon.setAttribute('class', 'fa-solid fa-xmark fa-2x');
        buttonObj.append(closeIcon);

        // Styles
        closeIcon.style.color = '#FFFF';
        closeIcon.addEventListener('mouseover', () => { closeIcon.style.color = 'red'; closeIcon.style.transition = 'ease .3s' });
        closeIcon.addEventListener('mouseout', () => { closeIcon.style.color = '#FFF'; closeIcon.style.transition = 'ease .3s' });

        buttonObj.style.background = 'transparent';
        buttonObj.style.border = 'transparent';
        
        for (let i = 0; i < collectionGasto.length; i++){
            titleDivObj.innerText = collectionGasto[i].nomeGasto;
            titleDivObj.style.fontWeight = 'bold';
            buttonObj.value = i;
        }
      
        divObj.appendChild(buttonObj);
        divObj.appendChild(titleDivObj);
        divObj.classList.add('pushedGastos');
        divObjGastos.appendChild(divObj); 
    

        buttonObj.addEventListener('click', () => { 
            let parentElement = buttonObj.parentNode;
            parentElement.remove();
            collectionGasto.splice(buttonObj.getAttribute('value'), 1);
            let getAllButton = document.querySelectorAll('#closeObjButton');
            
            getAllButton.forEach(el => el.value -= 1);

        });

    formPost.addEventListener('submit', () => {
        collectionInput.value = JSON.stringify(collectionGasto)
        localStorage.removeItem('gastos')
    })

    } 
});


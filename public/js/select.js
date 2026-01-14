const origenFiltro = document.getElementById('originFilter');
const destinoFiltro = document.getElementById('destinyFilter');

$(document).ready(function() {
    $(origenFiltro).select2();
});

$(document).ready(function() {
    $(destinoFiltro).select2();
});

document.addEventListener("DOMContentLoaded", () => {
const originInput = document.getElementById("originFilter");
const destinyInput = document.getElementById("destinyFilter");
const dateInput = document.getElementById("filterDate");
const clearButton = document.getElementById("clearFilters");
const flightCards = document.querySelectorAll(".flightCard");

console.log(originInput);

dateInput.addEventListener('change', ()=>{

    Filtrar();

})

$(origenFiltro).on('select2:select', ()=> {

    Filtrar();

});

$(destinoFiltro).on('select2:select', ()=> {

    Filtrar();

});

  
function Filtrar() {
    
    let origenVal = $(origenFiltro).val(); // Obtiene el valor seleccionado
    let destinyVal = $(destinoFiltro).val();
    let dateVal = dateInput.value;

    console.log(dateVal)

    flightCards.forEach(card => {

        var cardOrigin = origenVal;
        var cardDestiny = destinyVal;
        var cardDate = dateVal;

        if (destinyVal){

            cardDestiny = (card.dataset.destiny).toLowerCase();
            destinyVal = (destinyVal).toLowerCase();

        }  

        if (origenVal){

            cardOrigin = (card.dataset.origin).toLowerCase();
            origenVal = (origenVal).toLowerCase();

        }

        if (dateVal){

            cardDate = (card.dataset.date).toLowerCase();
            dateVal = (dateVal).toLowerCase();

        }

        if (origenVal == cardOrigin && destinyVal == cardDestiny && dateVal == cardDate) {
            card.style.display = "block";
        } else {
            card.style.display = "none";
        }
    });
    
}

clearButton.addEventListener("click", () => {
    originInput.value = "";
    destinyInput.value = "";
    dateInput.value = "";
    Filtrar();
});
});
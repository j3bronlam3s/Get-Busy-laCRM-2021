function calculate(){
    let subtotal = parseInt(document.querySelector('#subtotal').value);
    let taxes = parseInt(document.querySelector('#taxes').value);
    let people = parseInt(document.querySelector('#people').value);
    let tipRange = document.querySelector('#tipRange').value*.01;

    let tip = tipRange*subtotal + tipRange*taxes;
    let trueTotal = tip + subtotal + taxes;
    let totalpp = trueTotal/people;
    let subtotalpp = subtotal/people;
    let taxespp = taxes/people;
    let tippp = tip/people;

    document.querySelector('#tip').innerHTML = tip.toFixed(2);
    document.querySelector('#total').innerHTML = trueTotal.toFixed(2);
    document.querySelector('#totalpp').innerHTML = totalpp.toFixed(2);
    document.querySelector('#subtotalpp').innerHTML = subtotalpp.toFixed(2);
    document.querySelector('#taxespp').innerHTML = taxespp.toFixed(2);
    document.querySelector('#tippp').innerHTML = tippp.toFixed(2);
}

let slider = document.querySelector('#tipRange');
let value = document.querySelector('#tipValue')
slider.oninput = function(){
    value.innerHTML = slider.value
}


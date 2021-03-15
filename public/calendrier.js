console.log('JS chargé');

function modifierbordure(td) {
    //console.log(td)
    td.style.borderColor = "red"
    
    td.style.backgroundColor= "blue"
}
var td = document.querySelectorAll('td')

td.forEach(element => {
    console.log(element)
    element.addEventListener('click', function(){modifierbordure(element)})
});
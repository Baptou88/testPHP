console.log('JS chargé');

function supprbordure() {
    var td = document.querySelectorAll('td')

    td.forEach(element => {
        if (element.classList.contains("selected")) {
            element.classList.remove("selected")
        } 
    })
}
function modifierbordure(td) {
    //console.log(td)
    // td.style.borderColor = "red"
    
    if (td.classList.contains("selected")) {
        td.classList.remove("selected")
    } else
    {
        supprbordure()
        td.classList.add("selected")
    }
    
    // td.style.backgroundColor= "blue"
}
var td = document.querySelectorAll('td')

td.forEach(element => {
    // console.log(element)
    element.addEventListener('click', function(){modifierbordure(element)})
});
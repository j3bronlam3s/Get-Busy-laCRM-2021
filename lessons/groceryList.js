let groceryList = [];
let displayList = document.querySelector('#displayList')
function addGroceries(){
    let grocery = document.getElementById('newGrocery').value;
    let exists = false;
    groceryList.forEach(element => {
        if(element.includes(grocery)){
            ++element[1];
            exists = true;
        }
    })
    if(!exists){
        groceryList.push([grocery, 1]);
    }
    console.log(groceryList);
    displayGroceryList();
}
function deleteGrocery(){
    let grocery = document.getElementById('newGrocery').value;
    let exists = false;
    
    groceryList.forEach(element => {
        if(element.includes(grocery)){
            --element[1];
            if(element[1] === 0){
                let index = groceryList.indexOf(element);
                groceryList.splice(index, 1);
            }
            exists = true;
        }
    })
    if(!exists){
        alert('Item not found');
    }
    displayGroceryList();
}
function displayGroceryList(){
    displayList.innerHTML = ""
    groceryList.forEach(element => displayList.innerHTML += element[0] + " - " + element[1] + '<br>')
}
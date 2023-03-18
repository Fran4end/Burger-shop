var json = '{"hamburgers": [{"name": "Classic","price": 6.99,"ingredients": ["bun","beef patty","lettuce","tomato","sauce","cheese"]},{"name": "Double Cheeseburger","price": 6.99,"ingredients": ["bun","beef patty","lettuce","tomato","sauce","cheese"]},{"name": "Cheeseburger","price": 7.99,"ingredients": ["bun","beef patty","lettuce","tomato","sauce","cheddar cheese"]},{"name": "Bacon Burger","price": 8.99,"ingredients": ["bun","beef patty","lettuce","tomato","sauce","cheese","bacon"]},{"name": "Veggie Burger","price": 6.99,"ingredients": ["whole wheat bun","soy patty","lettuce","tomato","sauce","vegan cheese"]}]}';

document.addEventListener('DOMContentLoaded', () => {
    var obj = JSON.parse(json);
    var totalPrice = 0;
    obj.hamburgers.forEach(element => {
        totalPrice += element.price;
        document.querySelector('.disable-scrollbars').innerHTML += '<ul><li><img src="img/hamburger.png"></li><span><li>' + element.name + '</li><li><span id="price">' + element.price + '</span> €</li></span><span><span><li><button id="edit-button"><span class="material-symbols-rounded">edit</span></button></li><li><button id="delete-button"><ion-icon name="trash-outline"></ion-icon></button></li></span><li><select name="" id=""><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option></select></li></span></ul>'
    });

    document.querySelector('#total-price').innerHTML = totalPrice;

    document.querySelectorAll('.disable-scrollbars ul').forEach((element, i) => {
        element.querySelector('select').addEventListener('change', () => {
            element.querySelector('#price').innerHTML = (obj.hamburgers[i].price * element.querySelector('select').value).toFixed(2);
            document.querySelector('#total-price').innerHTML = totalPrices();
        });
    });

    if(listHeight() > document.querySelector('.disable-scrollbars').clientHeight){
        document.querySelector('.disable-scrollbars').innerHTML += '<div id="scroll-indicator"><ion-icon name="arrow-down-circle-outline"></ion-icon></div>'
    }

    editBurger(); 
    deleteBurger(); 
});

function listHeight(){
    var height = 0; 
    document.querySelectorAll('.disable-scrollbars ul').forEach((e) => {
        height += e.clientHeight + 40; 
    }); 
    return height; 
}

function totalPrices() {
    var totalPrice = 0;
    document.querySelectorAll('.disable-scrollbars ul').forEach((element) => {
        totalPrice += parseFloat(element.querySelector('#price').innerHTML);
    });
    return totalPrice.toFixed(2); 
}

function editBurger(){
    document.querySelectorAll('#edit-button').forEach((e) => {
        e.addEventListener('click', () => {
            openEditPage(e); 
        }); 
    }); 
}

function deleteBurger(){
    document.querySelectorAll('#delete-button').forEach((e) => {
        e.addEventListener('click', () => {
            document.querySelector('.disable-scrollbars').removeChild(e.parentNode.parentNode.parentNode.parentNode);
            document.querySelector('#total-price').innerHTML = totalPrices();
            if(document.querySelectorAll('.disable-scrollbars ul').length == 0){
                document.querySelector('.disable-scrollbars').innerHTML = '<p id="empty-checkout"><ion-icon name="close-circle-outline"></ion-icon> Nessun panino inserito</p>'
            }
        }); 
    }); 
}

function openEditPage(e){

}
var price = 0;
let list = {};
list['ingredients'] = {};
var data = '[{"id":1,"prezzo":0.5,"immagine":"paninohamburgernorm.png","nome":"Pane Bianco","tipo":"pane"},{"id":2,"prezzo":1.25,"immagine":"wurstel.jpg","nome":"Wurstel","tipo":"carne"},{"id":3,"prezzo":0.8,"immagine": "paneintegrale.jpg","nome":"Pane Integrale","tipo":"pane"},{"id":4,"prezzo":1.25,"immagine":"hamburger.jpg","nome":"Wurstel","tipo":"carne"}]';


//aggiunta dell'ingrediente al panino su richiesta dell'utente
function getIngredients(ingrediente, ammount, prezzo) {
    if (list['ingredients'][ingrediente] == null && ammount == 1) {
        list['ingredients'][ingrediente] = 1;
        price += prezzo;
    } else if ((list['ingredients'][ingrediente] == 0 || list['ingredients'][ingrediente] == null) && ammount == -1) {
        alert('Non ci sono ingredienti: ' + ingrediente);

    } else {
        list['ingredients'][ingrediente] += ammount;
        price += prezzo;
    }
    console.log(list['ingredients']);
}


function getBack() {
    list = [];
}

//Json contenente ordine effettuato dall'utente
function buildJson() {
    let text = document.querySelector('input').value;
    list['prezzo'] = price;
    list['nome'] = text;
    console.log(list);
    console.log(JSON.stringify(list));
    return JSON.stringify(list);
}


//Richiesta ingredienti disponibili nel database
function getHtml() {
    fetch('../../Controller/Ingredients.php')
    .then((res) => res.json())
    .then(data =>{
        console.log(data);
    data.forEach(element => {
        document.querySelector('#' + element.categoria).innerHTML += buildElement(element.nome, element.prezzo.toFixed(2), element.immagine); 
    });
})
}

function buildElement(name, price, image){
    return '<div><div><img src='+ image +'></div><div><p id="name">'+ name.charAt(0).toUpperCase() + name.replaceAll("_"," ").slice(1) +'</p><span><button>-</button><button>+</button></span><p id="price"><span id="amount">'+ price +'</span>€</p></div></div>'; 
}

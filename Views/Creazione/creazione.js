var list = new Array();
list['ingredients'] = new Array();
var price = 0; 
var data = '[{"id":1,"prezzo":0.5,"immagine":"Pane-bianco.png","nome":"Pane Bianco","tipo":"pane"},{"id":2,"prezzo":1.25,"immagine":"wurstel.png","nome":"Wurstel","tipo":"carne"},{"id":3,"prezzo":0.8,"immagine":"Pane-integrale.png","nome":"Pane Integrale","tipo":"pane"},{"id":4,"prezzo":1.25,"immagine":"hamburger.png","nome":"Wurstel","tipo":"carne"}]';

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

function buildJson() {
    text = document.querySelector('input').value;
    list['prezzo'] = price;
    list['nome'] = text;
    return JSON.stringify(list);

    
}

function getHtml() {
    /*fetch('creazione2.json')
    .then(data =>{
        data = JSON.parse(data);
        data.forEach(element => {
        var div1 = document.createElement('div');
        div1.className =  'singlebutton';
        var div2 = document.createElement('div');
        div2.className = 'ingrediente';
        var image = document.createElement('img');
        image.src = element.immagine;
        });
    }
    )*/
    data = JSON.parse(data);
    console.log(data);
    data.forEach(element => {
        var div1 = document.createElement('div');
        div1.className = 'singlebutton';
        var div2 = document.createElement('div');
        div2.className = 'ingrediente';
        var image = document.createElement('img');
        image.src = element.immagine;
        image.width = 200;
        image.height = 180;
        var p = document.createElement('p');
        p.appendChild(document.createTextNode(element.nome + ' ' + element.prezzo));
        var button1 = document.createElement('button');
        var button2 = document.createElement('button');
        button1.className = 'piu';
        button2.className = 'meno';
        var div3 = document.createElement('div');
        div3.className = 'piumeno';
        button1.onclick = function () {
            getIngredients(element.nome, 1, element.prezzo);
        };
        var imgp = document.createElement('img'); 
        imgp.src = 'https://img.favpng.com/4/5/15/computer-icons-symbol-addition-plus-and-minus-signs-png-favpng-NB4npaRQPe9p0HHCsuQNV1YD2.jpg';
        imgp.width = 50;
        imgp.height = 50;
        button1.appendChild(imgp);
        var imgm = document.createElement('img'); 
        imgm.src = 'https://icons-for-free.com/download-icon-math+minus+sign+stop+icon-1320184998453384308_512.png';
        imgm.width = 50;
        imgm.height = 50;
        button2.appendChild(imgm);
        button2.onclick = function () {
            getIngredients(element.nome, -1, element.prezzo);
        };
        div3.appendChild(button1);
        div3.appendChild(button2);
        div2.appendChild(image);
        div2.appendChild(document.createElement('br'));
        div2.appendChild(p);
        div1.appendChild(div2);
        div1.appendChild(div3);
        console.log(div1);
        document.getElementById(element.tipo).appendChild(div1);
    });

}

//'getIngredients('+element.nome+','+ -1+','+ element.prezzo+')'
var price = 0;
let list = {};
list['ingredients'] = {};

//aggiunta dell'ingrediente al panino su richiesta dell'utente
function getIngredients(ingrediente, prezzo, ammount, classe) {
    if (list['ingredients'][ingrediente] == null && ammount == 1) {
        list['ingredients'][ingrediente] = 1;
        price += prezzo;
        document.querySelector('#'+ingrediente).innerHTML+='<button id="number'+ingrediente+'">'+list["ingredients"][ingrediente]+'</button>';
    } else if ((list['ingredients'][ingrediente] == 0 || list['ingredients'][ingrediente] == null) && ammount == -1) {
        alert('Non ci sono ingredienti: ' + ingrediente);

    } else {
        list['ingredients'][ingrediente] += ammount;
        price += prezzo;
        document.getElementById(ingrediente).removeChild(document.getElementById('number'+ingrediente));
        document.querySelector('#'+ingrediente).innerHTML+='<button id="number'+ingrediente+'">'+list["ingredients"][ingrediente]+'</button>';
        if(list['ingredients'][ingrediente]==0){
            delete list['ingredients'][ingrediente];
            document.getElementById(ingrediente).removeChild(document.getElementById('number'+ingrediente));
            console.log(list['ingredients']);
        } 
    }
    if(classe=='pane'){
        let e = document.getElementsByClassName('pane');
        console.log(e);
        let i=-1;
        if(ammount==1){
            for(i=0; i<e.length;i++){
                console.log(e[i].id);
                if(!(e[i].id==('remove'+ingrediente))){
                    e[i].disabled=true;
                }
            }
        }
        if(ammount==-1){
            for(i=0;i<e.length;i++){
                console.log(e[i].id);
                if(!(e[i].id==('remove'+ingrediente))){
                    e[i].disabled=false;
                }
            }
        }
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
        .then(data => {
            console.log(data);
            data.forEach(element => {
                document.querySelector('#' + element.categoria).innerHTML += buildIngredients(element.nome, element.prezzo.toFixed(2), element.immagine, element.categoria);
            });
        })
}

function buildIngredients(name, price, image, classe) {
    return '<div><div><img src=' + image + '></div><div><p id="name">' + name.charAt(0).toUpperCase() + name.replaceAll("_", " ").slice(1) + '</p><span id="'+name+'"><button id="remove'+name+'" class="'+classe+'" onclick="getIngredients(`'+name+'`,'+price+','+'-1'+',`'+classe+'`)" >-</button><button id="add'+name+'" class="'+classe+'" onclick="getIngredients(`'+name+'`,'+price+','+'1'+',`'+classe+'`)">+</button></span><p id="price"><span id="amount">' + price + '</span>€</p></div></div>';
}

//Avvia un pop-up dove verrà chiesto il nome del panino e poi mandato alla pagina chekout
function goToChekout() {
    Swal.fire({
        title: 'Scrivi il nome del panino',
        input: 'text',
        inputAttributes: {
            autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'vai al checkout',
        showLoaderOnConfirm: true,
        preConfirm: (panino) => {
            //TODO: chiamare il file php per passare il json e andare al chekout
        },
        allowOutsideClick: () => !Swal.isLoading()
    })
}

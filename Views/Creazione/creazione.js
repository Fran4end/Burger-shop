var price = 0;
let list = {};
list['ingredients'] = {};

//aggiunta dell'ingrediente al panino su richiesta dell'utente
function getIngredients(ingrediente, prezzo, amount, classe) {
    if ((list['ingredients'][ingrediente] == 0 || list['ingredients'][ingrediente] == null) && amount == -1) {
        alert('Non ci sono ingredienti: ' + ingrediente.charAt(0).toUpperCase() + ingrediente.replaceAll("_", " ").slice(1));
    } else {
        document.getElementById(ingrediente).removeChild(document.getElementById('number' + ingrediente))
        list['ingredients'][ingrediente] = (list['ingredients'][ingrediente] == null && amount == 1) ? 1 : list['ingredients'][ingrediente] + amount;
        price += prezzo;
        let button = document.createElement("button");
        button.id = "number" + ingrediente;
        button.innerHTML = list["ingredients"][ingrediente];
        document.querySelector('#' + ingrediente).insertBefore(button, document.querySelector('#' + ingrediente).firstChild);
        if (list['ingredients'][ingrediente] == 0) {
            delete list['ingredients'][ingrediente];
        }
    }
    if (classe == 'pane') {
        disableBreadButton(amount, ingrediente);
    }
}

function disableBreadButton(amount, ingrediente) {
    let e = document.getElementsByClassName('pane');
    if (amount == 1) {
        for (const element of e) {
            if (element.id != ('remove' + ingrediente)) {
                element.disabled = true;
            }
        }
    } else {
        for (const element of e) {
            if (element.id != ('remove' + ingrediente)) {
                element.disabled = false;
            }
        }
    }
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
    return '<div class="wrapper">' +
        '<div class="form-box">' +
        '<h2>' + name.charAt(0).toUpperCase() + name.replaceAll("_", " ").slice(1) + '</h2>' +
        '<img class="image input-box" src=' + image + '>' +
        '<div class="input-box">' +
        '<span class="icon" id="' + name + '">' +
        '<button id="number' + name + '">0</button>' +
        '<button id="remove' + name + '" class="' + classe + '" onclick="getIngredients(`' + name + '`,' + price + ',' + '-1' + ',`' + classe + '`)">-</button>' +
        '<button id="add' + name + '" class="' + classe + '" onclick="getIngredients(`' + name + '`,' + price + ',' + '1' + ',`' + classe + '`)">+</button>' +
        '</span>' +
        '<p id="price">' +
        '<label for="price" id="amount">' + price + ' € x 1</label></p>' +
        '</div>' +
        '</div>';
}

/**
 * @Fran4end
 */
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
        confirmButtonColor: '#ffc21c',
        preConfirm: (panino) => {
            //TODO: chiamare il file php per passare il json e andare al chekout
            fetch('../../Controller/Burger.php',{
                method: 'POST',
                body: JSON.stringify(panino),
                headers: {"Content-type": "application/json;charset=UTF-8"}
            })
            
        },
        allowOutsideClick: () => !Swal.isLoading()
    })
}

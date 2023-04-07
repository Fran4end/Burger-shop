let price = 0;
let burger = {};
burger['ingredients'] = [];

function getIngredients(ingrediente, prezzo, amount, classe) {
    if ((burger['ingredients'][ingrediente] == 0 || burger['ingredients'][ingrediente] == null) && amount == -1) {
        Swal.fire({
            icon: 'error',
            title: 'Attenzione',
            text: 'Non ci sono ingredienti',
        })
    } else {
        document.getElementById(ingrediente).removeChild(document.getElementById('number' + ingrediente))
        burger['ingredients'][ingrediente] = (burger['ingredients'][ingrediente] == null && amount == 1) ? 1 : burger['ingredients'][ingrediente] + amount;
        price += prezzo;
        let button = document.createElement("button");
        button.id = "number" + ingrediente;
        button.innerHTML = burger["ingredients"][ingrediente];
        document.querySelector('#' + ingrediente).insertBefore(button, document.querySelector('#' + ingrediente).firstChild);
        if (burger['ingredients'][ingrediente] == 0) {
            delete burger['ingredients'][ingrediente];
        }
    }
    if (classe == 'pane') {
        disableBreadButton(amount, ingrediente);
    }
    console.log(burger);
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
    burger = [];
}

//Json contenente ordine effettuato dall'utente
function buildJson() {
    let text = document.querySelector('input').value;
    burger['prezzo'] = price;
    burger['nome'] = text;
    console.log(burger);
    console.log(JSON.stringify(burger));
    return JSON.stringify(burger);
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
function goToCheckout() {
    if (findBread() != null) {
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
            preConfirm: (nomePanino) => {
                fetch('../../Controller/Burger.php', {
                    method: 'POST',
                    body: prepareJSON(nomePanino),
                })
                    .then((res) => res.json())
                    .then((data) => {
                        if (data.result) {
                            document.location = "../checkout/checkout.html";
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Biricchino non sei ancora loggato!',
                            }).then(() => {
                                document.location = "../Login/LoginPage.html";
                            })
                        }
                    })

            },
            allowOutsideClick: () => !Swal.isLoading()
        })
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Devi ancora selezionare il pane!',
        })
    }
}

function prepareJSON(name) {
    let out = {
        "nome": name,
        "prezzo": price.toFixed(2),
        "pane": findBread(),
        "ingredienti": []
    };
    for (const key in burger["ingredients"]) {
        if (key != findBread()) {
            out.ingredienti.push({ "nome": key, "quantità": burger["ingredients"][key] });
        }
    }
    return JSON.stringify(out);
}

function findBread() {
    for (const key in burger["ingredients"]) {
        if (key.includes('pane')) {
            return key;
        }
    }
    return null;
}

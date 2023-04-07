let json;

window.onload = function () {
    fetch('../../Controller/Order.php')
    .then((res) => res.json())
    .then((data) => {
        json = data;
    }).then(() => fillBody());
}

function fillBody() {
    let totalPrice = 0;
    json.forEach(element => {
        totalPrice += parseFloat(element.prezzo);
        document.querySelector('.disable-scrollbars').innerHTML += '<ul><li><img src="img/hamburger.png"></li><span><li>' + element.nome + 
            '</li><li><span id="price">' + element.prezzo + '</span> €</li></span><span><span><li><button id="delete-button"><ion-icon name="trash-outline"></ion-icon></button></li></span><li><select name="" id=""><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option></select></li></span></ul>'
    });

    document.querySelector('#total-price').innerHTML = totalPrice.toFixed(2);

    document.querySelectorAll('.disable-scrollbars ul').forEach((element, i) => {
        element.querySelector('select').addEventListener('change', () => {
            element.querySelector('#price').innerHTML = (json[i].prezzo * element.querySelector('select').value).toFixed(2);
            document.querySelector('#total-price').innerHTML = totalPrices();
        });
    });

    deleteBurger();
}

function totalPrices() {
    let totalPrice = 0;
    document.querySelectorAll('.disable-scrollbars ul').forEach((element) => {
        totalPrice += parseFloat(element.querySelector('#price').innerHTML);
    });
    return totalPrice.toFixed(2);
}

function getPrezzo(nome) {
    for (const key in json) {
        if (json[key].nome == nome) {
            return json[key].prezzo;
        }
    }
    return 0;
}

function deleteBurger() {
    document.querySelectorAll('#delete-button').forEach((e) => {
        e.addEventListener('click', () => {
            nome = e.parentNode.parentNode.parentNode.parentNode.querySelector('span').firstChild.textContent;
            prezzo = getPrezzo(nome);
            document.querySelector('.disable-scrollbars').removeChild(e.parentNode.parentNode.parentNode.parentNode);
            document.querySelector('#total-price').innerHTML = totalPrices();
            if (document.querySelectorAll('.disable-scrollbars ul').length == 0) {
                document.querySelector('.disable-scrollbars').innerHTML = '<p id="empty-checkout"><ion-icon name="close-circle-outline"></ion-icon> Nessun panino inserito</p>'
            }
            fetch('../../Controller/DeleteBurger.php?nome='+nome+'&prezzo='+prezzo).then(() => location.reload());
        });
    });
}

let listOrder = []

window.onload = function () {
    fetch("../../Controller/Orders.php")
        .then((res) => res.json())
        .then((data) => {
            let b = true
            data = data.ordini
            if (data != undefined) {
                if (data.ordinati != undefined) {
                    createOrdered(data.ordinati);
                    b = false;
                }
                if (data.consegnati != undefined) {
                    createDelivered(data.consegnati);
                    b = false;
                }
                if (data.completati != undefined) {
                    createCompleted(data.completati);
                    b = false;
                }
                if (data.pagati != undefined) {
                    createPaid(data.pagati);
                    b = false;
                }
            }
            if (b) {
                let msg = document.createElement("h3")
                msg.className = "form-box"
                msg.innerHTML = "Non hai fatto nessun ordine";
                document.querySelector(".list").appendChild(msg)
            }
        })
    clickable();
}

function clickable() {
    let coll = document.querySelectorAll(".collapsible");
    for (const element of coll) {
        element.addEventListener("click", function () {
            this.classList.toggle("active");
            let content = this.nextElementSibling;
            if (content.style.maxHeight) {
                content.style.maxHeight = null;
            } else {
                content.style.maxHeight = content.scrollHeight + "px";
            }
        });
    }
}

function createOrdered(data) {
    document.querySelectorAll(".ordered").forEach((element) => element.style.display = 'flex')
    let container = document.querySelector("div.ordered");
    data.forEach(element => {
        container.appendChild(createElement(element));
    });
}

function createPaid(data) {
    document.querySelectorAll(".paid").forEach((element) => element.style.display = 'flex')
    let container = document.querySelector("div.paid");
    data.forEach(element => {
        container.appendChild(createElement(element));
    });
}

function createCompleted(data) {
    document.querySelectorAll(".completed").forEach((element) => element.style.display = 'flex')
    let container = document.querySelector("div.completed");
    data.forEach(element => {
        container.appendChild(createElement(element));
    });
}

function createDelivered(data) {
    document.querySelectorAll(".delivered").forEach((element) => element.style.display = 'flex')
    let container = document.querySelector("div.delivered");
    data.forEach(element => {
        container.appendChild(createElement(element));
    });
}

function createElement(element) {
    listOrder.push(element)
    let order = document.createElement("div")
    order.className = "form-box"
    order.innerHTML =
        '<img class="min-image" src="./multiHamburger.png">' +
        '<div class="input-box">' +
        '<span onclick="detail(' + element.id + ')" class="icon">' +
        '<p>' + element.panini.length + '</p>' +
        '<em class="fa fa-list"></em>' +
        '</span>' +
        '<p id="price">' +
        '<label for="price" id="amount">' + element.prezzo + ' € </label>' +
        '</p>' +
        '</div>'
    return order
}

function detail(id) {
    let order = listOrder.find(element => element.id == id)
    let detail = document.createElement("div")
    detail.className = "banner__wrapper"
    detail.onclick = function () { document.querySelector(".banner__wrapper").remove() }
    detail.innerHTML =
        '<div class="banner">' +
        '</div>'
    document.body.appendChild(detail)
    detail.style.display = "flex";
    order.panini.forEach((panino, index) => {
        let burger = document.createElement('div')
        burger.className = "detail-wrapper"
        burger.innerHTML =
            '<div class="min-wrapper" id="left">' +
            panino.nome +
            '<img class="min-image" src="../checkout/img/hamburger.png">' +

            '</div>' +
            '<div class="min-wrapper" id="right">' +
            '</div>';
        document.querySelector(".banner").appendChild(burger);
        panino.ingredienti.forEach((ingrediente) => {
            let ing = document.createElement("div");
            ing.className = "ing-wrapper"
            ing.innerHTML =
                '<p>' +
                ingrediente.quantità + ' x ' + ingrediente.nome.charAt(0).toUpperCase() + ingrediente.nome.replaceAll("_", " ").slice(1) +
                '</p>';
            document.querySelectorAll('#right')[index].appendChild(ing);
        });
    });

}
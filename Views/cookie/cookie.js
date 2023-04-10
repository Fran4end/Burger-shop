window.onload = function () {
    fetch("/Burger-shop/Controller/cookie.php")
        .then((res) => res.json())
        .then((data) => {
            if (!data.accept) {
                document.querySelector('.banner').style.display = 'flex';
                document.body.style.overflow = 'hidden';
            } else {
                document.querySelector('.banner').style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        })
}
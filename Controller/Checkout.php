<?php

include '../Models/Panino.php';
include '../Models/Ingrediente.php';
include '../Models/Ordine.php';

session_start();

// if the user isn't logged
if(!isset($_SESSION['user'])){
    ?>
        <script>
            if (!alert('biricchino, non sei loggato'))
                document.location = 'Login.php';
        </script>
    <?php
}

if (isset($_REQUEST['panino'])) {
    // decodes the json
    $json = json_decode($_REQUEST['panino'], true);

    // gets the User form the db
    $user = new Utente('a', 'a');  //lazy initialization
    $user_id = $_SESSION['user']['User_ID'];
    $user->getUtenteById($user_id);

    // creates the Ordine
    $order = new Ordine();
    $amount = 0;
    foreach ($json as $value) {
        $amount += $value['prezzo'];
    }

    // if the user hasn't enough 'schei' the server doesn't do anything
    if ($amount > $user->getSaldo()) {
        ?>
            <script>
                if (!alert('no schei'))
                    document.location = 'Annulla.php';
            </script>
        <?php
        header('Location: ../Views/Home/home.html');
        return;
    } else { // otherwise decrement the salt (doesn't affect db)
        $user->updateSaldo(-$amount, $user_id);
    }

    $order->setPrezzo($amount);
    $order_id = $order->createOrder($user_id);

    //creates the Panini
    $ingrediente = new Ingrediente();
    $all_ingredients = $ingrediente->getAll();

    $panino = new Panino();

    foreach ($json as $value) {
        $panino->setNome($value['nome']);
        $panino->setPrezzo($value['prezzo']);
        $panino->createBurger($order_id);

        // creates all the Preparazioni
        foreach ($value['ingredienti'] as $ing) {
            $panino->addIngrediente(
                getIngredientId($ing['nome'], $all_ingredients),
                $order_id,
                $ing['quantità']
            );
        }
    }
    header('Location: ../Views/Home/home.html');
} else {
    ?>
        <script>
            if (!alert('nessun parametro passato, ci scusiamo, ma i nostri programmatori sono sottopagati ;)'))
                document.location = 'Annulla.php';
        </script>
    <?php
}


function getIngredientId($name, $all) {
    foreach ($all as $ing) {
        if ($ing['nome'] == $name) {
            return $ing['id'];
        }
    }
    return -1;
}
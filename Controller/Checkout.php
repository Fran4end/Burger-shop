<?php

/**
 * Performs the checkout when the 'Ordina' button is pressed and saves everything in the db.
 */

include '../Models/Panino.php';
include '../Models/Ingrediente.php';
include '../Models/Ordine.php';
include 'logged.php';

session_start();
// if the user isn't logged redirects to login
if (!isset($_SESSION['user'])) {
    echo json_encode(["result" => false]);
}else{
    // if the user correctly sent the json containing the panini
    if (!empty(json_decode(file_get_contents('php://input'), true))) {
        // decodes the json and clear the SESSION
        $json = json_decode(file_get_contents('php://input'), true);
        
        // gets the User form the db
        $user = new Utente('a', 'a');  //lazy initialization
        $user_id = $_SESSION['user']['User_ID'];
        $user->getUtenteById($user_id);

        // creates the Ordine
        $order = new Ordine();
        $amount = 0;
        foreach ($json as $value) {
            $amount += $value['prezzo'] * $value['quantità'];
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

        foreach ($json as $burger) {
            // creates the same Panino (and all the Preparazioni) for panino['quantità'] times 
            for ($i = 0; $i < $burger['quantità']; $i++) {

                $panino->setNome($burger['nome']);
                $panino->setPrezzo($burger['prezzo']);
                $panino->createBurger($order_id);

                // creates all the Preparazioni
                foreach ($burger['ingredienti'] as $ing) {
                    $panino->addIngrediente(
                        getIngredientId($ing['nome'], $all_ingredients),
                        $order_id,
                        $ing['quantità'],
                    );
                }
            }
        }

        // deletes the order in the SESSION and redirects to home
        unset($_SESSION['order']);
        echo json_encode(["result" => true]);
    } else { //if the data of the order don't exist
        ?>
            <script>
                if (!alert('nessun parametro passato, ci scusiamo, ma i nostri programmatori sono sottopagati ;)'))
                    document.location = 'Annulla.php';
            </script>
        <?php
    }
}



/**
 * Iterates an array of Ingredienti to obtain the id of the Ingredient by the name.
 * 
 * @param string $name the name of the Ingrediente to find
 * @param array $all the array containing al the Ingredienti to iterate
 */
function getIngredientId($name, $all) {
    foreach ($all as $ing) {
        if ($ing['nome'] == $name) {
            return $ing['id'];
        }
    }
    return -1;
}
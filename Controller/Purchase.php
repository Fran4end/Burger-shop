<?php
require_once '../Models/Panino.php';
require_once '../Models/Ingrediente.php';
require_once '../Models/Ordine.php';
require_once '../Models/Utente.php';

// if the user correctly sent the json containing the panini
if (!empty(json_decode(file_get_contents('php://input'), true))) {
    // decodes the json 
    $json = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($_REQUEST['token'])) {
        http_response_code(422);
        echo 'Token not found';
        exit;
    }

    $user = new Utente('a', 'a');
    try {
        $user = $user->getUtenteByToken($_REQUEST['token']);
    } catch (Exception $e) {
        http_response_code(422);
        echo 'Wrong token';
        exit;
    }

    $user_id = $user->getId();

    // creates the Ordine
    $order = new Ordine();
    $amount = 0;
    foreach ($json as $value) {
        $amount += $value['prezzo'] * $value['quantità'];
    }

    // if the user hasn't enough 'schei' the server doesn't do anything
    if ($amount > $user->getSaldo()) {
        http_response_code(402);
        echo 'User hasn\'t enough schei';
        exit;
    } else { // otherwise decrement the salt (doesn't affect db)
        $user->updateSaldo(-$amount, $user_id);
    }

    $order->setPrezzo($amount);
    $order_id = $order->createOrder($user_id);
    $order->setPagato($order_id);

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
    http_response_code(422);
    echo 'No parameters';
    exit;
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
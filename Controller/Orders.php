<?php

/**
 * If the user is logged, returns a json containing the orders, the panini and the ingredienti of a User
 * TODO: adattarlo
 */

require_once '../Models/Utente.php';
require_once '../Models/Ordine.php';
require_once '../Models/Panino.php';
require_once '../Models/Ingrediente.php';

if(isset($_REQUEST['token'])){
    $userObj = new Utente('a', 'a');
    try {
        $userObj = $userObj->getUtenteByToken($_REQUEST['token']);
    } catch (Exception $e) {
        http_response_code(422);
        echo 'Wrong token';
        exit;
    }

    //gets all the orders based on the user id
    $orderObj = new Ordine();
    $orders = $orderObj->getOrdersByUser($userObj->getId());

    // if the user has no orders, returns an empty json
    if(empty($orders)){
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');
        echo json_encode($orders);
        exit;
    }

    // creates all the orders, based on the category (and adds the schei)
    $ordersJson['saldo'] = $userObj->getSaldo();
    foreach($orders as $order){
        if($order['pagato'] && $order['consegnato']){
            $ordersJson['ordini']['completati'][] = addOrder($order);
        }else if($order['pagato']){
            $ordersJson['ordini']['pagati'][] = addOrder($order);
        }else if($order['consegnato']){
            $ordersJson['ordini']['consegnati'][] = addOrder($order);
        }else{
            $ordersJson['ordini']['ordinati'][] = addOrder($order);
        }
    }

    header("Access-Control-Allow-Origin: *");
    header('Content-Type: application/json');
    echo json_encode($ordersJson);
}else {
    http_response_code(422);
    echo 'No parameters';
    exit;
}

/**
 * Returns an array containing all the orders.
 * Every order has: ``id``, ``prezzo``, ``panini``.
 * To create the array of panini, ``addPanini()`` the function is used. 
 *
 * @param array $order an array containing the data of a user
 * @return array an array containing all the Orders
 * @author ErosM04
 */
function addOrder($order){
    $arr['id'] = $order['id'];
    $arr['prezzo'] = $order['prezzo'];
    $arr['panini'] = addPanini($order['id']);
    return $arr;
}

/**
 * Returns an array containing all the panini of a specific order.
 * Every panino has: ``id``, ``nome``, ``pronto``, ``prezzo``.
 *
 * @param int $id_order the id of the order
 * @return array an array containing all the Panini
 * @author ErosM04
 */
function addPanini($id_order){
    $paninoObj = new Panino();
    $panini = $paninoObj->getPaninoByOrder($id_order);
    $arr = array();

    // gets the ingredienti and add the panino to the array
    foreach($panini as $panino){
        $panino['ingredienti'] = addIngredienti($id_order, $panino['id']);
        $arr[] = $panino;
    }

    return $arr;
}

/**
 * Returns an array containing all the Ingredienti of a specific panino.
 * Every ingrediente has: ``id``, ``prezzo``, ``immagine``,  ``nome``, ``categoria``.
 *
 * @param int $id_order the id of the order
 * @param int $id_panino the id of the panino
 * @return array an array containing all the Panini
 * @author ErosM04
 */
function addIngredienti($id_order, $id_panino){
    $ingredientObj = new Ingrediente();
    $ingredienti = $ingredientObj->getIngredientiByPanino($id_order, $id_panino);
    $arr = array();

    foreach($ingredienti as $ingrediente){
        $arr[] = $ingrediente;
    }

    return $arr;
}
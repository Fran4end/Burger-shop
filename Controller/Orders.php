<?php

/**
 * If the user is logged, returns a json containing the orders and the panini of a User
 * @author ErosM04
 */

require_once '../Models/Ordine.php';
require_once '../Models/Panino.php';
require_once '../Models/Ingrediente.php';

session_start();

if(isset($_SESSION['user'])){

    //gets all the orders based on the user id
    $orderObj = new Ordine();
    $user = json_decode($_SESSION['user'], true);
    $orders = $orderObj->getOrdersByUser($user['User_ID']);

    // if the user has no orders, returns an empty json
    if(empty($orders)){
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');
        echo json_encode($orders);
        exit;
    }

    // creates all the orders, based on the category
    $ordersJson;
    foreach($orders as $order){
        if($order['pagato'] && $order['consegnato']){
            $ordersJson['completati'][] = addOrder($order);
        }else if($order['pagato']){
            $ordersJson['pagati'][] = addOrder($order);
        }else if($order['consegnato']){
            $ordersJson['consegnati'][] = addOrder($order);
        }else{
            $ordersJson['ordinati'][] = addOrder($order);
        }
    }

    header("Access-Control-Allow-Origin: *");
    header('Content-Type: application/json');
    echo json_encode($ordersJson);
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
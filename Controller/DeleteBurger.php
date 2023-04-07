<?php

/**
 * If the user is logged, reads the name and the prezzo of the panino to delete from the GET
 * and deletes it from the order in the SESSION.
 */

session_start();
// deletes the panino only if the user is logged and the GET contains the name and the prezzo
if(isset($_SESSION['user']) && isset($_SESSION['order']) && isset($_GET['nome']) && isset($_GET['prezzo'])){
    
    $order = json_decode($_SESSION['order'], true);
    // print_r($order);

    foreach($order as $key => $panino){
        if($panino['nome'] == $_GET['nome'] && $panino['prezzo'] == $_GET['prezzo']){
            unset($order[$key]);
            break;
        }
    }

    // rebuilds the order from zero to assure it will be in the correct format
    $orderJson;
    foreach($order as $panino){
        $orderJson[] = $panino;
    }

    // if there are no orders left returns delete the order, otherwise update the order in the SESSION
    if(empty($orderJson)){
        unset($_SESSION['order']);
    }else{
        $_SESSION['order'] = json_encode($orderJson);
    }
}
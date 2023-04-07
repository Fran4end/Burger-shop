<?php

/**
 * Returns a json containing all the panini saved in the current SESSION (actual order), if the user is logged
 */

session_start();

// if the user is logged returns the json
if(isset($_SESSION['user'])){
    header("Access-Control-Allow-Origin: *");
    header('Content-Type: application/json');

    // if the order exists returns the order json, otherwise returns a empty json 
    if(isset($_SESSION['order'])){
        echo $_SESSION['order'];
    }else{
        echo json_encode(array());
    }
    
    
}
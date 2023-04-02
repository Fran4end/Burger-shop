<?php

// returns a json containg the data of the user, if he is logged

session_start();

if(isset($_SESSION['user'])){    
    header("Access-Control-Allow-Origin: *");
    header('Content-Type: application/json');
    echo $_SESSION['user'];
}
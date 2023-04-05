<?php

// returns a json containing all the panini saved in the current SESSION, if the user is logged

session_start();

if(isset($_SESSION['user']) && isset($_SESSION['order'])){
    header("Access-Control-Allow-Origin: *");
    header('Content-Type: application/json');
    echo $_SESSION['order'];
}
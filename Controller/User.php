<?php

session_start();

if(isset($_SESSION['user'])){    
    header("Access-Control-Allow-Origin: *");
    header('Content-Type: application/json');
    echo $_SESSION['user'];
}


?>
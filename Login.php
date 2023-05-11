<?php

require 'Models/Utente.php';

$user = new Utente('a', 'a');  //buffer initialization

if(isset($_REQUEST['name']) && isset($_REQUEST['password'])){
    try { // try catch necessario in caso si inserisca un nome utente che non esiste
        $user = $user->getUtenteByName($_REQUEST['name']);
    } catch (Exception $e) {
        http_response_code(422);
        echo 'User not found';
        exit;
    }
    
    if($_REQUEST['password'] == $user->getPassword()){ // verifica che la password corrisponda
        echo json_encode(["token" => $user->getToken()]);
        exit;
    }else{
        http_response_code(422);
        echo 'Password incorrect';
        exit;
    }
}else{
    http_response_code(422);
    echo 'No parameters';
    exit;
}

?>
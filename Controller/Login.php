<?php

require '../Models/Utente.php';

$user = new Utente('a', 'a');  //buffer initialization

if(isset($_REQUEST['name']) && isset($_REQUEST['password'])){
    try { // try catch necessario in caso si inserisca un nome utente che non esiste
        $user = $user->getUtenteByName($_REQUEST['name']);
    } catch (\Throwable $th) {
        //error code 422
    }
    
    if($_REQUEST['password'] == $user->getPassword()){ // verifica che la password corrisponda
        //ritornare il token
    }else{
        //error code 422
    }
}else{
    //error code 422
    error();
}

public function error()
{
    header("HTTP/1.1 422 Unprocessable Content");
}

?>
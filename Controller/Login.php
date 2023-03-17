<?php

require '../Models/Utente.php';

$user = new Utente('a', 'a');  //lazy initialization

if(isset($_REQUEST['name'])){
    try { // try catch necessario in caso si inserisca un nome utente che non esiste
        $user = $user->getUtenteByName($_REQUEST['name']);    
    } catch (\Throwable $th) {
        header('Location: ../Views/Login/LoginPage.html');
    }
    if($_REQUEST['password'] == $user->getPassword()){ // verifica che la password corrisponda
        header('Location: ../Views/Mainpage.html');
    }else{
        header('Location: ../Views/Login/LoginPage.html');
    }
}else{
    header('Location: ../Views/Login/LoginPage.html');
}


?> 
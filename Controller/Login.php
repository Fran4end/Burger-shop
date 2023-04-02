<?php

require '../Models/Utente.php';

session_start();

$user = new Utente('a', 'a');  //lazy initialization

if(isset($_REQUEST['name'])){
    try { // try catch necessario in caso si inserisca un nome utente che non esiste
        $user = $user->getUtenteByName($_REQUEST['name']);    
    } catch (\Throwable $th) {
        header('Location: ../Views/Login/LoginPage.html');
    }
    
    if($_REQUEST['password'] == $user->getPassword()){ // verifica che la password corrisponda
        $_SESSION['auth'] = true;
        $_SESSION['user'] = $user->toJSON();
        header('Location: ../Views/Home/home.html');
    }else{
        $_SESSION['auth'] = false;
        header('Location: ../Views/Login/LoginPage.html');
    }
}else{
    header('Location: ../Views/Login/LoginPage.html');
}
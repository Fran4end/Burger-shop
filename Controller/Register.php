<?php

require '../Models/Utente.php';

session_start();

$user = '';

if(isset($_REQUEST['name']) && isset($_REQUEST['password']) && $_REQUEST['name'] != '' && $_REQUEST['password'] != ''){
    $user = new Utente($_REQUEST['name'], $_REQUEST['password']);
    $user->createUtente();
    print_r($user->toJSON());
    $_SESSION['auth'] = true;
    $_SESSION['user'] = $user->toJSON();
    header('Location: ../Views/Home/home.html');
}else{
    header('Location: ../Views/Register/Register.html');
    $_SESSION['auth'] = false;
    session_destroy();
}




?>
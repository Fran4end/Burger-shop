<?php

require '../Models/Utente.php';

$user;

if(isset($_REQUEST['name']) && isset($_REQUEST['password']) && $_REQUEST['name'] != '' && $_REQUEST['password'] != ''){
    $user = new Utente($_REQUEST['name'], $_REQUEST['password']);
    $user->createUtente();
    // print_r($user->toJSON());
    header('Location: ../Views/Mainpage.html');
}else{
    header('Location: ../Views/Register/Register.html');
}



?>
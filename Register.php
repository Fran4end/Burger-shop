<?php

require 'Models/Utente.php';

$user = '';

if (isset($_REQUEST['name']) && isset($_REQUEST['password']) 
&& $_REQUEST['name'] != '' && $_REQUEST['password'] != '') {
    $user = new Utente($_REQUEST['name'], $_REQUEST['password']);
    try {
        $buff = $user->getUtenteByName($_REQUEST['name']);
        http_response_code(422);
        echo 'Usermame already used';
        exit;
    } catch (Exception $e) {
        $user->createUtente();
        //ritornare il token
        echo json_encode($user->getToken());
        exit;
    }
} else {
    http_response_code(422);
    echo 'No parameters';
    exit;
}

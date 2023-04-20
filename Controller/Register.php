<?php

require '../Models/Utente.php';

$user = '';

if (isset($_REQUEST['name']) && isset($_REQUEST['password']) && $_REQUEST['name'] != '' && $_REQUEST['password'] != '') {
    $user = new Utente($_REQUEST['name'], $_REQUEST['password']);
    if (empty($user->getUtenteByName($_REQUEST['name']))) {
        $user->createUtente();
        //ritornare il token
    } else {
        //error code 422
    }
} else {
    //error code 422
}
?>

</html>
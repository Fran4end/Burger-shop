<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<?php

require '../Models/Utente.php';

session_start();

$user = '';

if (
    isset($_REQUEST['name']) && isset($_REQUEST['password']) &&
    $_REQUEST['name'] != '' && $_REQUEST['password'] != ''
) {
    $user = new Utente($_REQUEST['name'], $_REQUEST['password']);
    if (empty($user->getUtenteByName($_REQUEST['name']))) {
        $user->createUtente();
        print_r($user->toJSON());
        $_SESSION['auth'] = true;
        $_SESSION['user'] = $user->toJSON();
        header('Location: ../Views/Home/home.html');
    } else {
?>
        <script>
            
            $(document).ready(function () {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Il nome è già stato usato',
                // footer: '<a href="">Why do I have this issue?</a>'
            }).then(() => document.location = "../Views/Register/Register.html")
        })
        </script>
<?php

    }
} else {

    $_SESSION['auth'] = false;
    session_destroy();
}
?>

</html>
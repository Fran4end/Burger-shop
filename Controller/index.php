<?php 
    session_start();
    if (isset($_SESSION['auth']) && $_SESSION['auth']) {
        header('Location: ../Views/home/home.html');
    }else{
        header('Location: ../Views/Login/LoginPage.html');
    }
?>
<?php 
    session_start();
    
    // if the user is logged redirects to home, otherwise redirects to login
    if (isset($_SESSION['user']) && $_SESSION['user'] != null) {
        header('Location: ../Views/home/home.html');
    }else{
        header('Location: ./Login.php');
    }
?>
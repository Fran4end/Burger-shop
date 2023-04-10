<?php

/**
 * Clears the actual order in the SESSION, if it exists, and redirects to home page.
 */

session_start();

if(isset($_SESSION['order'])){
    unset($_SESSION['order']);
}

header('Location: ../Views/home/home.html');
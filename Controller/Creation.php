<?php

// redirects the user from the homepage to the creation of the panino

include 'logged.php';

session_start();
// if the user isn't logged redirects to login
checkLogin();

header('Location: ../Views/Creazione/creazione.html');
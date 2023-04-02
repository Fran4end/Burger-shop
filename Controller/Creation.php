<?php

// redirects the user from the homepage to the creation of the panino

session_start();

// if the user isn't logged redirects to login
if(!isset($_SESSION['user'])){
    ?>
        <script>
            if (!alert('biricchino, non sei loggato'))
                document.location = 'Login.php';
        </script>
    <?php
}

header('Location: ../Views/Creazione/creazione.html');
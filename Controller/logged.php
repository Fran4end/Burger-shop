<?php

/**
 * Checks if the User is logged by looking at $_SESSION['user'].
 * If the user is logged doesn't do anything. Otherwise shows an alert and then redirects to the login page.
 * 
 * @author: ErosM04 
 */
function checkLogin(){
    if(!isset($_SESSION['user'])){
        ?>
            <script>
                if (!alert('biricchino, non sei loggato'))
                    document.location = 'Login.php';
            </script>
        <?php
    }
}
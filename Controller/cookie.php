<?php
header("content-type: application/json");
function setCk($name, $value)
{
    setcookie($name, $value, time() + (60 * 60 * 24 * 90));
}
function delateCk($name)
{
    if ($_COOKIE[$name] != null) {
        unset($_COOKIE[$name]);
    }
}
function getCk($name)
{
    if (isset($_COOKIE[$name])) {
        return $_COOKIE[$name];
    } else {
        return "Il cookie non esiste";
    }
}

if (isset($_REQUEST['accept'])) {
    if ($_REQUEST['accept'] == "accept") {
        setcookie("accept", 1, time() + (60 * 60 * 24 * 90), '/');
        if (isset($_REQUEST['cookies'])) {
            foreach ($_REQUEST['cookies'] as $key => $cookie) {
                setCk($key, $cookie);
            }
        }
    } else {
        setcookie("accept", 0, time() + (60 * 60 * 24 * 90), '/');
        if (isset($_REQUEST['cookies'])) {
            foreach ($_REQUEST['cookies'] as $key => $cookie) {
                delateCk($key);
            }
        }
    }
    header('Location: ../Views/Login/LoginPage.html');
} else {
    if (!isset($_COOKIE['accept'])) {
        echo json_encode(["accept" => false]);
    } else {
        echo json_encode(["accept" => true]);
        if (isset($_REQUEST['cookies'])){
            if ($_COOKIE['accept']) {
                foreach ($_REQUEST['cookies'] as $key => $cookie) {
                    setCk($key, $cookie);
                }
            } else {
                foreach ($_REQUEST['cookies'] as $key => $cookie) {
                    delateCk($key);
                }
            }
        }
    }
}

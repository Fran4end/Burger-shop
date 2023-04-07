<?php
session_start();
/**
 * After creating the panino, this file is called and 
 * saves the panino into the SESSION, then redirects to the checkout  
 */

$burger = json_decode(file_get_contents('php://input'), true);

// if a panino is passed, saves it in SESSION['order']

// if the user isn't logged redirects to login

if (!isset($_SESSION['user'])) {
   echo json_encode(["result" => false]);
} else {
   // if the order field in SESSION already exists, add the new panino, otherwise creates the order in the SESSION
   if (isset($_SESSION['order'])) {
      $order = json_decode($_SESSION['order'], true);
      $order[] = $burger;
      unset($_SESSION['order']);
      $_SESSION['order'] = json_encode($order);
   } else {
      $order[] = json_decode(file_get_contents('php://input'), true);
      $_SESSION['order'] = json_encode($order);
   }
   echo json_encode(["result" => true]);
}

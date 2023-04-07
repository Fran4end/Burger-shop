<?php
session_start();
/**
 * After creating the panino in the View, this file is called and 
 * saves the panino into the SESSION, then tells the js to redirect the user
 * to the login.
 * @author ErosM04, Fran4end, TmsRvl
 */

// if the user isn't logged tells the js to redirect the user to the login
if (!isset($_SESSION['user'])) {
   echo json_encode(["result" => false]);
} else {
   // reads the json sent by the user 
   $burger = json_decode(file_get_contents('php://input'), true);

   // checks if the json file containing the new panino sent by the user exist
   if(empty($burger)){
      echo json_encode(["result" => false]);
      exit;
   }

   // if the order field in SESSION already exists, adds the new panino, otherwise creates the order in the SESSION
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

<?php

include '../Models/Panino.php';
include '../Models/Ingrediente.php';
include '../Models/Ordine.php';

session_start();    

if(isset($_REQUEST['json']) && isset($_SESSION['user'])){
   // decodes the json
   $json = json_decode($_REQUEST['json'], true);

   // gets the User form the db
   $user = new Utente('a', 'a');  //lazy initialization
   $user_id =$_SESSION['user']['User_ID'];
   $user->getUtenteById($user_id);

   // creates the Ordine
   $order = new Ordine();
   $amount = 0;
   foreach ($json as $value) {
      $amount += $value['prezzo'];
   }

   // if the user hasn't enough 'schei' the server doesn't do anything
   if($amount > $user->getSalt()){
      return;
   }else{ // otherwise decrement the salt (doesn't affect db)
      $user->updateSalt(-$amount);
   }

   $order->setPrezzo($amount);
   $order_id = $order->createOrder($user_id);
   
   //creates the Panini
   $ingrediente = new Ingrediente();
   $all_ingredients = $ingrediente->getAll();
   
   $panino = new Panino();

   foreach ($json as $value) {
      $panino->setNome($value['nome']);
      $panino->setPrezzo($value['prezzo']);
      $panino->createBurger($order_id);

      // creates all the Preparazioni
      foreach($value['ingredienti'] as $ing){
         $panino->addIngrediente(
            getIngredientId($ing['nome'], $all_ingredients, $ing['quantità']),
            $order_id,
         );
      }
   }

   // after completing the operations redirects to the home page
   header('Location: ../Views/Home/home.html');

}

function getIngredientId ($name, $all){
   foreach($all as $ing){
      if($ing['nome'] == $name){
         return $ing['id'];
      }
   }
   return -1;
}
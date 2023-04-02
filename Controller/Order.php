<?php

session_start();

// if the user isn't logged
if(!isset($_SESSION['user'])){
   ?>
       <script>
           if (!alert('biricchino, non sei loggato'))
               document.location = 'Login.php';
       </script>
   <?php
}

$_REQUEST['panino'] = '{
   "nome": "Classic",
   "prezzo": 10,
   "pane": "pane_bianco",
   "ingredienti":[
      {
           "nome": "pomodoro",
           "quantità": 2
      },
      {
           "nome": "pomodoro",
           "quantità": 3
      } 
   ]
}';

// if a panino is passed, saves it in SESSION['order']
if(isset($_REQUEST['panino']) && $_REQUEST['panino'] != ''){

   // if the order field in SESSION already exists, add the new panino, otherwise creates the order in the SESSION
   if(isset($_SESSION['order'])){
      $order = json_decode($_SESSION['order'], true);
      $order[] = json_decode($_REQUEST['panino'], true);
      unset($_SESSION['order']);
      $_SESSION['order'] = json_encode($order);
   }else{
      $order[] = json_decode($_REQUEST['panino'], true); 
      $_SESSION['order'] = json_encode($order);
   }

   header('Location: ../Views/checkout/checkout.html');
}else{ // redirects to home page
   ?>
       <script>
           if (!alert('nessun parametro passato, ci scusiamo, ma i nostri programmatori sono sottopagati ;)'))
               document.location = 'Annulla.php';
       </script>
   <?php
}
<?php

//File used to test model files

include 'Ingrediente.php';
include 'Ordine.php';
include 'Utente.php';
include 'Panino.php';

// TEST UTENTE
// $utente= new Utente('Dotolin','aaaa');
// $utente->setAvatar('https://banner2.cleanpng.com/20180616/gce/kisspng-logo-icon-design-computer-icons-i-symbol-5b25798a777a97.6605128115291826024894.jpg%27');
// $utente->createUtente();
// $prova=$utente->getAll();
// print($prova);
// echo '<br>';

// TEST ORDINE
// try {
//     $ordine = new Ordine();
//     $ordine->setPrezzo(20);
//     $ordine->createOrder(5);
//     $prova2 = $ordine->getAll();
// } catch (\Throwable $th) {
//     echo $th;
// }

// TEST INGREDIENTE
// $ordine->deleteOrder(2);
// $ingrediente = new Ingrediente();
// $ingrediente->getIngredienteById(2);
// echo $ingrediente->toJSON();
/* 
{
  "Ingredient_ID": 2,
  "Ingredient_Name": "bisi",
  "Image": "ciao.png",
  "Price": 44
}
*/
// print_r($ingrediente->getAll());
/* Array (
    [0] => Array ( [id] => 2 [prezzo] => 44 [immagine] => ciao.png [nome] => bisi ) 
    [1] => Array ( [id] => 3 [prezzo] => 2 [immagine] => verza.png [nome] => verza ) 
   )
*/

// TEST PANINO
// $panino = new Panino();
// $panino->setNome('pan');
// $panino->setPrezzo(12);
// $panino->createBurger(3);
// $panino->addIngrediente(2, 3);

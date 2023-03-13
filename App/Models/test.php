<?php 

include 'Ingrediente.php';
include 'Ordine.php';
include 'Panino.php';
include 'Utente.php';

$manageIngr = new Ingrediente();

$ingredients = $manageIngr.getAll();

print_r($ingredients);

?>
<?php
include 'Ingrediente.php';

$manager = new Ingrediente();
$ingredients = $manager->getIngredienteById(7);
print_r($ingredients);
?>
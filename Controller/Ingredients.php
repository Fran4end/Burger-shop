<?php
include '../Models/Ingrediente.php';
$ingredient = new Ingrediente;
print_r(ingredientsToJson($ingredient->getAll()));


function ingredientsToJson($ingredients)
{
  return json_encode($ingredients->getAll());
}


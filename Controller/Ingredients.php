<?php
include '../Models/Ingrediente.php';
 $ingredient = new Ingrediente;
 ingredientsToJson($ingredient ->getAll());


function ingredientsToJson($ingredients) {
    $jsonIngredients= array();
    foreach ($ingredients as $thisIngredient) {
      $jsonArray[] = array(
        'id' => $thisIngredient['id'],
        'prezzo' => $thisIngredient['nome'],
        'immagine' => $thisIngredient['prezzo'],
        'nome' => $thisIngredient['immagine'],
      );
    }
    return json_encode($jsonIngredients);
  }

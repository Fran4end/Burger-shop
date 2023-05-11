<?php

/**
 * Returns a json containing all the ingredients in the db
 */

header("content-type: application/json");

include 'Models/Ingrediente.php';
$ingredient = new Ingrediente();
echo json_encode($ingredient->getAll());

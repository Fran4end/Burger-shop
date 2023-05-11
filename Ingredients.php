<?php

/**
 * Returns a json containing all the ingredients in the db
 */

header('Content-Type: application/json; charset=utf-8');

include 'Models/Ingrediente.php';
$ingredient = new Ingrediente();
echo json_encode($ingredient->getAll());
exit;

<?php
include '../Models/Ingrediente.php';
$ingredient = new Ingrediente();
echo json_encode($ingredient->getAll());



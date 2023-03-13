<?php
include 'Ingrediente.php';
include 'Ordine.php';
include 'Utente.php';
include 'Panino.php';

$utente= new Utente('Dotolin','aaaa');
$utente->setAvatar('https://banner2.cleanpng.com/20180616/gce/kisspng-logo-icon-design-computer-icons-i-symbol-5b25798a777a97.6605128115291826024894.jpg');
$utente->createUtente();
$prova=$utente->getAll();
print($prova);


?>
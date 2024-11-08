<?php
require '../../../config/config.php';
require '../../../MVC/Controller/VendasController.php';

$controller = new VendaController($pdo);
$controller->criarVenda();
header('Location: ../../Views/VendasViews.php');


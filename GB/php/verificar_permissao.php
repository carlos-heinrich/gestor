<?php
session_start();

function verificarPermissao($niveisPermitidos) {
    if (!isset($_SESSION['tipo_funcionario']) || !in_array($_SESSION['tipo_funcionario'], $niveisPermitidos)) {
        header('Location:  ../Portifolio/index.php');
        exit();
    }
}
?>

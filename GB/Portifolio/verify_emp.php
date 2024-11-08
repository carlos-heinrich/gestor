<?php
if(!$_SESSION['id_empresa'] or !$_SESSION['cnpj']) {
    header('Location: ../php/login_empresa.php'); 
    exit();
}

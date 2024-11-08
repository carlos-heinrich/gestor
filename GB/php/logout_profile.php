<?php 
session_start();
unset($_SESSION['id_user']);
unset($_SESSION['nome_completo']);
unset($_SESSION['tipo_funcionario']);

header('Location: login.php');
exit();
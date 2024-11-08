<?php
require 'verificar_permissao.php';

// Verifica se o usuário tem permissão para acessar esta página
verificarPermissao([1, 2, 3]);

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário
    $id_fiscal = $_POST['id'];
    $transacoes = $_POST['transacoes'];
    $fatura = $_POST['fatura'];
    $imposto = $_POST['imposto'];
    $orcamentos = $_POST['orcamentos'];

    // Configuração do Banco de Dados
    $host = 'localhost';
    $dbname = 'bike';
    $username = 'root';
    $password = '';

    try {
        // Conexão com o Banco de Dados
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erro ao conectar: " . $e->getMessage());
    }

    // Query de atualização
    $sql = "UPDATE controlefiscal SET transacoes = :transacoes, fatura = :fatura, imposto = :imposto, orcamentos = :orcamentos WHERE id_fiscal = :id";

    // Preparar e executar a declaração de atualização
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':transacoes', $transacoes);
    $stmt->bindParam(':fatura', $fatura);
    $stmt->bindParam(':imposto', $imposto);
    $stmt->bindParam(':orcamentos', $orcamentos);
    $stmt->bindParam(':id', $id_fiscal);
    $stmt->execute();

    // Redireciona de volta para a página anterior após a atualização
    header("Location: controle_fiscal.php");
    exit();
} else {
    // Se o formulário não foi submetido, redirecione de volta para a página anterior
    header("Location: sua_pagina_anterior.php");
    exit();
}
?>

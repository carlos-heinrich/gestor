<?php
require 'verificar_permissao.php';

// Verifica se o usuário tem permissão para acessar esta página
verificarPermissao([1, 2, 3]);

// Verifica se o ID fiscal foi fornecido na URL
if (isset($_GET['id'])) {
    // Captura o ID fiscal fornecido na URL
    $id_fiscal = $_GET['id'];

    // Configuração do Banco de Dados
    $host = 'localhost';
    $dbname = 'bike';
    $username = 'root';
    $password = '';

    try {
        // Conexão com o Banco de Dados
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Query para excluir o registro
        $sql = "DELETE FROM controlefiscal WHERE id_fiscal = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id_fiscal, PDO::PARAM_INT);
        $stmt->execute();

        // Redireciona de volta para a página anterior após a exclusão
        header("Location: controle_fiscal.php");
        exit();
    } catch (PDOException $e) {
        die("Erro ao excluir registro: " . $e->getMessage());
    }
} else {
    // Se o ID fiscal não foi fornecido, redirecione de volta para a página anterior
    header("Location: Foi Não   ");
    exit();
}


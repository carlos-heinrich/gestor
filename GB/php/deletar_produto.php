<?php
// Verifique se o ID do produto a ser deletado foi passado através da URL
if (isset($_GET['id'])) {
    // Incluir arquivo de configuração do banco de dados
    include_once '../config/config.php';
    
    // Prepare uma declaração DELETE
    $sql = "DELETE FROM controleestoque WHERE id_estoque = :id";
    
    try {
        // Preparar a declaração
        $stmt = $pdo->prepare($sql);
        
        // Vincular parâmetros
        $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        
        // Executar a declaração
        $stmt->execute();
        
        // Redirecionar de volta para a página anterior após a exclusão
        header("Location: controle_estoque.php");
        exit();
    } catch (PDOException $e) {
        // Lidar com erros de exclusão
        echo "Erro ao deletar o produto: " . $e->getMessage();
    }
} else {
    // Se o ID não foi passado, redirecione para a página anterior
    header("Location: index.php");
    exit();
}


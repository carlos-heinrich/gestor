<?php
// Verifique se o ID da venda está presente na URL
if(isset($_GET['id'])) {
    // Inclua o arquivo de configuração do banco de dados
    require_once '../config/config.php';

    try {
        // Prepare uma declaração SQL para excluir a venda
        $sql = "DELETE FROM vendas WHERE id_venda = ?";

        // Preparar e executar a declaração
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_GET['id']]);

        echo "Venda deletada com sucesso.";
    } catch (PDOException $e) {
        echo "Erro ao deletar a venda: " . $e->getMessage();
    }
} else {
    echo "ID da venda não fornecido.";
}
?>

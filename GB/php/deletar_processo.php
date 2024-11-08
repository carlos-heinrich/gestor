<?php
include '../config/config.php';

// Verifica se o ID foi passado pela URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Deleta o processo pelo ID
    $stmt = $pdo->prepare("DELETE FROM processos WHERE id = :id");
    $stmt->execute(['id' => $id]);

    echo "Processo excluído com sucesso!";
    header("Location: listar_processos.php"); // Redireciona para a lista de processos
    exit;
} else {
    die("ID do processo não especificado!");
}
?>

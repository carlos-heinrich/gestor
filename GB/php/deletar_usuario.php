<?php
require_once 'C:\xampp\htdocs\gestao_bikes\GB\config\config.php';

if (isset($_GET['id_user'])) {
    $id_user = $_GET['id_user'];

    try {
        $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id_user = ?");
        $stmt->execute([$id_user]);

   
        header('Location:gestaorh.php');
    } catch (PDOException $e) {
        echo "<p>Erro ao deletar empresa: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p>ID do usuário não fornecido.</p>";
}




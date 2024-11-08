<?php
// Conectar ao banco de dados
$host = 'localhost';
$dbname = 'bike';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Configurar PDO para lançar exceções
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificar se o ID foi enviado
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        // Preparar a declaração SQL para remoção do item
        $stmt = $conn->prepare("DELETE FROM controleestoque WHERE id_estoque = :id");
        $stmt->bindParam(':id', $id);
        // Executar a declaração SQL
        $stmt->execute();
        echo "Item removido com sucesso!";
    } else {
        echo "ID do item não especificado!";
    }
} catch(PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

$conn = null;
?>

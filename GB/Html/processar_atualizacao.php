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

    // Verificar se todos os campos do formulário estão presentes
    if (isset($_POST['id'], $_POST['nome_produto'], $_POST['quantidade'], $_POST['preco'], $_POST['tipo'], $_POST['data'], $_POST['fornecedor'])) {
        // Obter os dados do formulário
        $id = $_POST['id'];
        $nome_produto = $_POST['nome_produto'];
        $quantidade = $_POST['quantidade'];
        $preco = $_POST['preco'];
        $tipo = $_POST['tipo'];
        $data = $_POST['data'];
        $fornecedor = $_POST['fornecedor'];

        // Preparar a declaração SQL para atualizar o item do estoque
        $stmt = $conn->prepare("UPDATE controleestoque SET nomedoproduto = :nome_produto, quantidade = :quantidade, preco = :preco, tipo = :tipo, data = :data, fornecedor = :fornecedor WHERE id_estoque = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome_produto', $nome_produto);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':data', $data);
        $stmt->bindParam(':fornecedor', $fornecedor);

        // Executar a declaração SQL
        $stmt->execute();

        echo "Item atualizado com sucesso!";
    } else {
        echo "Todos os campos do formulário devem ser preenchidos.";
    }
} catch(PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

$conn = null;
?>

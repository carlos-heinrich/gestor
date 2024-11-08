<?php
// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se todas as informações necessárias foram recebidas
    if (isset($_POST['id_venda']) && isset($_POST['produto']) && isset($_POST['valor']) && isset($_POST['quantidade']) && isset($_POST['total']) && isset($_POST['data'])) {
        // Extrair as informações do formulário
        $id_venda = $_POST['id_venda'];
        $produto = $_POST['produto'];
        $valor = $_POST['valor'];
        $quantidade = $_POST['quantidade'];
        $total = $_POST['total'];
        $data = $_POST['data'];

        // Configuração de conexão com o banco de dados
        $host = 'localhost';
        $dbname = 'bike';
        $username = 'root';
        $password = '';

        // Conexão com o banco de dados
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro ao conectar: " . $e->getMessage());
        }

        // Query para atualizar os dados da venda no banco de dados
        $sql = "UPDATE vendas SET produto = :produto, valor = :valor, quantidade = :quantidade, total = :total, data = :data WHERE id_venda = :id_venda";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':produto', $produto);
        $stmt->bindParam(':valor', $valor);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':total', $total);
        $stmt->bindParam(':data', $data);
        $stmt->bindParam(':id_venda', $id_venda); // Add this line
        $stmt->execute();

        // Redirecionar de volta para a página de listagem de vendas após a atualização
        header("Location: controle_vendas.php");
        exit();
    } else {
        echo "Erro: Informações incompletas.";
    }
} else {
    echo "Erro: Método de requisição inválido.";
}
?>

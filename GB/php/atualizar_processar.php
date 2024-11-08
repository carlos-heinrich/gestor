<?php
$host = 'localhost';
$dbname = 'bike';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar: " . $e->getMessage());
}

// Verifica se os dados do formulário foram enviados via POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Acesso inválido.");
}

// Verifica se todos os campos do formulário foram preenchidos
if (empty($_POST['id_fiscal']) || empty($_POST['transacoes']) || empty($_POST['fatura']) || empty($_POST['imposto']) || empty($_POST['orcamentos'])) {
    die("Todos os campos são obrigatórios.");
}

$id_fiscal = $_POST['id_fiscal'];
$transacoes = $_POST['transacoes'];
$fatura = $_POST['fatura'];
$imposto = $_POST['imposto'];
$orcamentos = $_POST['orcamentos'];

try {
    // Atualiza os dados na tabela controlefiscal
    $sql = "UPDATE controlefiscal SET transacoes = :transacoes, fatura = :fatura, imposto = :imposto, orcamentos = :orcamentos WHERE id_fiscal = :id_fiscal";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':transacoes', $transacoes);
    $stmt->bindParam(':fatura', $fatura);
    $stmt->bindParam(':imposto', $imposto);
    $stmt->bindParam(':orcamentos', $orcamentos);
    $stmt->bindParam(':id_fiscal', $id_fiscal);
    $stmt->execute();

    // Redireciona de volta para a página principal após a atualização
    header('Location: controle_fiscal.php');
    exit();
} catch (PDOException $e) {
    die("Erro ao atualizar dados: " . $e->getMessage());
}
?>

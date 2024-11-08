<?php
require_once 'C:\xampp\htdocs\gestao_bikes\GB\config\config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_empresa = $_POST['id_empresa'];
    $nome = $_POST['nome'];
    $servicos = $_POST['servicos'];
    $cnpj = $_POST['cnpj'];
    $cep = $_POST['cep'];
    $estado = $_POST['estado'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];

    try {
        $stmt = $pdo->prepare("UPDATE cadastro_empresa SET nome = ?, servicos = ?, cnpj = ?, cep = ?, estado = ?, rua = ?, numero = ? WHERE id_empresa = ?");
        $stmt->execute([$nome, $servicos, $cnpj, $cep, $estado, $rua, $numero, $id_empresa]);
        header('Location:controle_empresa.php');
    } catch (PDOException $e) {
        echo "<p>Erro ao atualizar empresa: " . $e->getMessage() . "</p>";
    }
}
?>

<a href="controle_empresa.php">Voltar para a página inicial</a>

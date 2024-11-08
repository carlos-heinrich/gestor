<?php
include '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numero_processo = $_POST['numero_processo'];
    $descricao = $_POST['descricao'];
    $status = $_POST['status'];

    $sql = "INSERT INTO processos (numero_processo, descricao, status) VALUES (:numero_processo, :descricao, :status)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['numero_processo' => $numero_processo, 'descricao' => $descricao, 'status' => $status]);

    echo "Processo cadastrado com sucesso!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastrar Processo</title>
</head>
<body>
    <h1>Cadastrar Processo</h1>
    <form method="POST" action="">
        <label>Número do Processo:</label>
        <input type="text" name="numero_processo" required><br>
        <label>Descrição:</label>
        <textarea name="descricao" required></textarea><br>
        <label>Status:</label>
        <input type="text" name="status" required><br>
        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>

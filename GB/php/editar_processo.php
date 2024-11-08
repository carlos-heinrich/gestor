<?php
include '../config/config.php';

// Verifica se o ID foi passado pela URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Busca os dados do processo pelo ID
    $stmt = $pdo->prepare("SELECT * FROM processos WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $processo = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$processo) {
        die("Processo não encontrado!");
    }

    // Atualiza os dados do processo se o formulário for enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $numero_processo = $_POST['numero_processo'];
        $descricao = $_POST['descricao'];
        $status = $_POST['status'];

        $sql = "UPDATE processos SET numero_processo = :numero_processo, descricao = :descricao, status = :status WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'numero_processo' => $numero_processo,
            'descricao' => $descricao,
            'status' => $status,
            'id' => $id
        ]);

        echo "Processo atualizado com sucesso!";
        header("Location: listar_processos.php"); // Redireciona para a lista de processos
        exit;
    }
} else {
    die("ID do processo não especificado!");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Processo</title>
</head>
<body>
    <h1>Editar Processo</h1>
    <form method="POST" action="">
        <label>Número do Processo:</label>
        <input type="text" name="numero_processo" value="<?php echo $processo['numero_processo']; ?>" required><br>
        <label>Descrição:</label>
        <textarea name="descricao" required><?php echo $processo['descricao']; ?></textarea><br>
        <label>Status:</label>
        <input type="text" name="status" value="<?php echo $processo['status']; ?>" required><br>
        <button type="submit">Salvar Alterações</button>
    </form>
</body>
</html>

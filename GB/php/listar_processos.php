<?php
include '../config/config.php';

$stmt = $pdo->query("SELECT * FROM processos ORDER BY data_criacao DESC");
$processos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Listagem de Processos</title>
</head>
<body>
    <h1>Processos</h1>
    <table border="1">
        <tr>
            <th>Número do Processo</th>
            <th>Descrição</th>
            <th>Status</th>
            <th>Data de Criação</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($processos as $processo): ?>
        <tr>
            <td><?php echo $processo['numero_processo']; ?></td>
            <td><?php echo $processo['descricao']; ?></td>
            <td><?php echo $processo['status']; ?></td>
            <td><?php echo $processo['data_criacao']; ?></td>
            <td>
                <a href="editar_processo.php?id=<?php echo $processo['id']; ?>">Editar</a>
                <a href="deletar_processo.php?id=<?php echo $processo['id']; ?>">Deletar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

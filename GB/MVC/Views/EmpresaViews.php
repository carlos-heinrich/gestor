<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Css/controlefrota.css">
    <title>Document</title>
</head>
<body>
    

<div class="comeco">
        <div class="retangulo"></div>

    </div>
    

</body>
</html>

<?php
    require_once 'C:\xampp\htdocs\gestao_bikes\GB\config\config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['nome'];
        $servicos = $_POST['servicos'];
        $cnpj = $_POST['cnpj'];
        $cep = $_POST['cep'];
        $estado = $_POST['estado'];
        $rua = $_POST['rua'];
        $numero = $_POST['numero'];

        try {
            $stmt = $pdo->prepare("INSERT INTO cadastro_empresa (nome, servicos, cnpj, cep, estado, rua, numero) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$nome, $servicos, $cnpj, $cep, $estado, $rua, $numero]);
            echo "<p>Empresa cadastrada com sucesso!</p>";
        } catch (PDOException $e) {
            echo "<p>Erro ao cadastrar empresa: " . $e->getMessage() . "</p>";
        }
    }

    // Exibir empresas cadastradas
    echo "<h2>Empresas Cadastradas</h2>";
    echo "<table>";
    echo "<tr><th>Nome</th><th>Serviços</th><th>CNPJ</th><th>CEP</th><th>Estado</th><th>Rua</th><th>Número</th></tr>";

    try {
        $stmt = $pdo->query("SELECT * FROM cadastro_empresa");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
            echo "<td>" . htmlspecialchars($row['servicos']) . "</td>";
            echo "<td>" . htmlspecialchars($row['cnpj']) . "</td>";
            echo "<td>" . htmlspecialchars($row['cep']) . "</td>";
            echo "<td>" . htmlspecialchars($row['estado']) . "</td>";
            echo "<td>" . htmlspecialchars($row['rua']) . "</td>";
            echo "<td>" . htmlspecialchars($row['numero']) . "</td>";
            echo "</tr>";
        }
    } catch (PDOException $e) {
        echo "<p>Erro ao exibir empresas: " . $e->getMessage() . "</p>";
    }

    echo "</table>";
    ?>
</body>
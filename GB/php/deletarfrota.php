<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bike";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Função para deletar veículo
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id_frota'])) {
    $id_frota = $_GET['id_frota'];
    $sql = "DELETE FROM controlefrota WHERE id_frota=$id_frota";

    if ($conn->query($sql) === TRUE) {
        echo "";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/controlefrota.css">
    <title>Deletar Veículo</title>
</head>
<body>
    <div class="content">
        <div class="container">
            <h1>Deletar Veículo</h1>
            <p>Veículo deletado com sucesso. <a href="controle_frota.php">Voltar</a></p>
        </div>
    </div>
</body>
</html>

<?php
require 'verificar_permissao.php';
verificarPermissao([1]);

$host = 'localhost';
$dbname = 'bike';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verifica se o ID foi passado
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];

        // Busca os dados da solicitação
        $stmt = $pdo->prepare("SELECT * FROM solicitacao WHERE id_soli = ?");
        $stmt->execute([$id]);
        $solicitacao = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$solicitacao) {
            die("Solicitação não encontrada.");
        }
    } else {
        die("ID inválido.");
    }

    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Coleta os dados do formulário
        if (isset($_POST['solicitante']) && isset($_POST['responsavel']) && isset($_POST['pedido']) && isset($_POST['situacao'])) {
            $solicitante = $_POST['solicitante'];
            $responsavel = $_POST['responsavel'];
            $pedido = $_POST['pedido'];
            $situacao = $_POST['situacao'];

            // Prepara e executa a atualização no banco de dados
            $stmt = $pdo->prepare("UPDATE solicitacao SET solicitante = :solicitante, responsavel = :responsavel, pedido = :pedido, situacao = :situacao WHERE id_soli = :id");
            $stmt->execute(array(
                ':solicitante' => $solicitante,
                ':responsavel' => $responsavel,
                ':pedido' => $pedido,
                ':situacao' => $situacao,
                ':id' => $id
            ));

            // Feedback para o usuário
            echo "<p class='message'>Solicitação atualizada com sucesso!</p>";
            // Redireciona para a página principal após a atualização
            header("Location: ../MVC/public/Solicitacao/index.php");
            exit();
        } else {
            echo "<p class='message'>Por favor, preencha todos os campos.</p>";
        }
    }
} catch (PDOException $e) {
    die("Erro ao conectar: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/solicitacaoatendidas.css">
    <title>GESTÃO DE BIKES</title>
</head>

<body>
    <div class="comeco">
        <div class="retangulo"></div>
        <h1 class="titulo">Sistema De Gestão ERP+controle de empresas e de pessoas</h1>
       <a href="../Portifolio/index.php"><img class="logo" src="../Img/bitrix-removebg-preview.png" width="300px"></a> 
    </div>

    <div class="sidebar">
        <button onclick="window.location.href='../Portifolio/index.php'">Home</button>
        <button onclick="window.location.href='../MVC/public/Solicitacao/index.php'">Solicitações Pendentes</button>
    </div>

    <div class="main-content">
        <div class="table-container">
            <h2>Editar Solicitação</h2>
            <form method="post" action="">
                <label for="solicitante">Solicitante:</label>
                <input type="text" id="solicitante" name="solicitante" value="<?php echo $solicitacao['solicitante']; ?>" required><br>

                <label for="responsavel">Responsável:</label>
                <input type="text" id="responsavel" name="responsavel" value="<?php echo $solicitacao['responsavel']; ?>" required><br>

                <label for="pedido">Pedido:</label>
                <input type="text" id="pedido" name="pedido" value="<?php echo $solicitacao['pedido']; ?>" required><br>

                <label for="situacao">Situação:</label>
                <input type="text" id="situacao" name="situacao" value="<?php echo $solicitacao['situacao']; ?>" required><br>

                <input type="submit" value="Atualizar">
            </form>
        </div>
    </div>
</body>

</html>

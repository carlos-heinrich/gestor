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

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $marca = isset($_POST['marca']) ? $conn->real_escape_string($_POST['marca']) : '';
    $ano_fabricado = isset($_POST['ano_fabricado']) ? $conn->real_escape_string($_POST['ano_fabricado']) : '';
    $modelo = isset($_POST['modelo']) ? $conn->real_escape_string($_POST['modelo']) : '';
    $tipodeveiculo = isset($_POST['tipodeveiculo']) ? $conn->real_escape_string($_POST['tipodeveiculo']) : '';
    $id_frota = isset($_POST['id_frota']) ? intval($_POST['id_frota']) : 0;

    if (isset($_FILES['imagem']) && $_FILES['imagem']['tmp_name']) {
        $imagem_nome = $_FILES['imagem']['name'];
        $imagem_temp = $_FILES['imagem']['tmp_name'];
        $imagem_caminho = "../uploads/" . $imagem_nome;

        if (move_uploaded_file($imagem_temp, $imagem_caminho)) {
            // Usar apenas o caminho da imagem no banco de dados
            $imagem_caminho_db = $conn->real_escape_string($imagem_caminho);
            $sql = "UPDATE controlefrota SET marca='$marca', ano_fabricado='$ano_fabricado', modelo='$modelo', tipodeveiculo='$tipodeveiculo', imagem='$imagem_caminho_db' WHERE id_frota=$id_frota";
        } else {
            echo "Erro ao fazer upload da imagem.";
            exit; // Se houver um erro no upload da imagem, sair do script.
        }
    } else {
        $sql = "UPDATE controlefrota SET marca='$marca', ano_fabricado='$ano_fabricado', modelo='$modelo', tipodeveiculo='$tipodeveiculo' WHERE id_frota=$id_frota";
    }

    if ($conn->query($sql) === TRUE) {
        echo "";
    } else {
        echo "Erro ao atualizar veículo: " . $conn->error;
    }
}

// Função para pegar dados do veículo a ser editado
$vehicle_to_edit = null;
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id_frota'])) {
    $id_frota = intval($_GET['id_frota']);
    $sql = "SELECT * FROM controlefrota WHERE id_frota=$id_frota";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $vehicle_to_edit = $result->fetch_assoc();
    } else {
        echo "Veículo não encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/controlefrota.css">
    <title>Atualizar Veículo</title>
</head>
<body>
    <div class="content">
        <div class="container">
            <h1>Atualizar Veículo</h1>
            <?php if ($vehicle_to_edit): ?>
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="edit_vehicle" value="1">
                    <input type="hidden" name="id_frota" value="<?php echo $vehicle_to_edit['id_frota']; ?>">
                    <label for="marca">Marca:</label>
                    <input type="text" id="marca" name="marca" value="<?php echo $vehicle_to_edit['marca']; ?>" required><br>
                    <label for="ano_fabricado">Ano Fabricado:</label>
                    <input type="text" id="ano_fabricado" name="ano_fabricado" value="<?php echo $vehicle_to_edit['ano_fabricado']; ?>" required><br>
                    <label for="modelo">Modelo:</label>
                    <input type="text" id="modelo" name="modelo" value="<?php echo $vehicle_to_edit['modelo']; ?>" required><br>
                    <label for="tipodeveiculo">Tipo do Veiculo:</label>
                    <input type="text" id="tipodeveiculo" name="tipodeveiculo" value="<?php echo $vehicle_to_edit['tipodeveiculo']; ?>" required><br>
                    <label for="imagem">Imagem:</label>
                    <input type="file" id="imagem" name="imagem"><br>
                    <input type="submit" value="Atualizar Veículo">
                </form>
            <?php else: ?>
                <p>Veículo atualizado com sucesso! <a href="controle_frota.php">Voltar</a></p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

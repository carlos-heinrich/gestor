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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nomedoproduto = $_POST['nomedoproduto'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];
    $tipo = $_POST['tipo'];
    $data = $_POST['data'];
    $fornecedor = $_POST['fornecedor'];
    $imagem = $_FILES['imagem']['name'];

    if ($imagem) {
        // Diretório de upload
        $target_dir = "../MVC/public/Estoque/uploads/";
        $target_file = $target_dir . basename($imagem);

        // Verificar se é uma imagem real
        $check = getimagesize($_FILES['imagem']['tmp_name']);
        if ($check === false) {
            die("O arquivo não é uma imagem.");
        }


        // Tamanho máximo do arquivo (5MB)
        if ($_FILES['imagem']['size'] > 5000000) {
            die("Desculpe, seu arquivo é muito grande.");
        }

        // Extensões permitidas
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            die("Desculpe, apenas arquivos JPG, JPEG e PNG são permitidos.");
        }

        // Tentar mover o arquivo
        if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $target_file)) {
            die("Desculpe, houve um erro ao enviar seu arquivo.");
        }

        // SQL com imagem
        $sql = "UPDATE controleestoque SET nomedoproduto = :nomedoproduto, quantidade = :quantidade, preco = :preco, tipo = :tipo, data = :data, fornecedor = :fornecedor, imagem = :imagem WHERE id_estoque = :id";
    } else {
        // SQL sem imagem
        $sql = "UPDATE controleestoque SET nomedoproduto = :nomedoproduto, quantidade = :quantidade, preco = :preco, tipo = :tipo, data = :data, fornecedor = :fornecedor WHERE id_estoque = :id";
    }

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nomedoproduto', $nomedoproduto);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':data', $data);
        $stmt->bindParam(':fornecedor', $fornecedor);
        if ($imagem) {
            $stmt->bindParam(':imagem', $imagem);
        }
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
      header('Location: controle_estoque.php');
    } catch (PDOException $e) {
        die("Erro ao atualizar o registro: " . $e->getMessage());
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM controleestoque WHERE id_estoque = :id";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            die("Registro não encontrado.");
        }
    } catch (PDOException $e) {
        die("Erro ao buscar o registro: " . $e->getMessage());
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
    <link rel="stylesheet" href="../Css/atualizar_estoque.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
<div class="comeco">
        <h1 class="titulo"> Sistema De Gestão ERP+controle de empresas e de pessoas </h1>
        <a href="../Portifolio/index.php"><img class="logo" src="../Img/bitrix-removebg-preview.png"></a>
    </div><br><br>

    <section>
        <div class="sidebar">
            <button onclick="window.location.href='../Portifolio/index.php'">Home</button>
            <button onclick="window.location.href='../php/controle_estoque.php'">Produtos Cadastrados</button>
        </div>
        <div class="container">
            <div class="form-container">
     

<form class="formstyle" method="post" action="atualizar.php" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id_estoque']); ?>">
    <label for="nomedoproduto">Nome do Produto:</label>
    <input type="text" name="nomedoproduto" value="<?php echo htmlspecialchars($row['nomedoproduto']); ?>"><br>
    <label for="quantidade">Quantidade:</label>
    <input type="text" name="quantidade" value="<?php echo htmlspecialchars($row['quantidade']); ?>"><br>
    <label for="preco">Preço:</label>
    <input type="text" name="preco" value="<?php echo htmlspecialchars($row['preco']); ?>"><br>
    <label for="tipo">Tipo:</label>
    <input type="text" name="tipo" value="<?php echo htmlspecialchars($row['tipo']); ?>"><br>
    <label for="data">Data:</label>
    <input type="text" name="data" value="<?php echo htmlspecialchars($row['data']); ?>"><br>
    <label for="fornecedor">Fornecedor:</label>
    <input type="text" name="fornecedor" value="<?php echo htmlspecialchars($row['fornecedor']); ?>"><br>
    <label for="imagem">Imagem:</label>
    <input type="file" name="imagem"><br>
    <input type="submit" value="Atualizar">
</form>
            </div>
        </div>
    </section>

</body>

</html>
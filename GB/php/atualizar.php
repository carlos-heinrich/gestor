

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

        // Verificar se o arquivo já existe
        if (file_exists($target_file)) {
            die("Desculpe, o arquivo já existe.");
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
        echo "Registro atualizado com sucesso!";
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
<html>
<head>
    <title> Produto atualizado! </title>
</head>
<body>
  <style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #2c3e50, #4ca1af);
    color: #ffffff;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

h2 {
    text-align: center;
    font-size: 2em;
    margin-bottom: 20px;
    color: #ffffff;
    text-shadow: 0 0 10px rgba(0, 255, 255, 0.7);
}

form {
    background: rgba(44, 62, 80, 0.9);
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 255, 255, 0.5);
    max-width: 500px;
    width: 100%;
}

label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
    text-transform: uppercase;
}

input[type="text"],
input[type="file"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #4ca1af;
    border-radius: 5px;
    background: rgba(255, 255, 255, 0.1);
    color: #ffffff;
    transition: background 0.3s, border-color 0.3s;
}

input[type="text"]:focus,
input[type="file"]:focus {
    background: rgba(255, 255, 255, 0.2);
    border-color: #1abc9c;
    outline: none;
}

input[type="submit"] {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 5px;
    background: linear-gradient(135deg, #1abc9c, #16a085);
    color: #ffffff;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s;
}

input[type="submit"]:hover {
    background: linear-gradient(135deg, #16a085, #1abc9c);
}

.a {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 20px;
    border-radius: 5px;
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: #ffffff;
    text-decoration: none;
    font-weight: bold;
    transition: background 0.3s;
    text-decoration:none;
}

.a:hover {
    background: linear-gradient(135deg, #c0392b, #e74c3c);
}


.conect {
    text-decoration: none;
    color: white;
    font-weight: bolder;
}

button {
    background-color: blue;
    border: 0.5px;
    box-shadow: 0.25px 0.5px 0.25px 0.5px;
    margin: 15px;
}

    </style>
    <br> 
<button><a class="conect" href="controle_estoque.php">  Voltar</a></button>

</body>
</html>

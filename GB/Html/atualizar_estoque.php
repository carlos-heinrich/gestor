<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Item do Estoque</title>
</head>
<body>
    <h2>Atualizar Item do Estoque</h2>
    <?php
    // Conectar ao banco de dados
    $host = 'localhost';
    $dbname = 'bike';
    $username = 'root';
    $password = '';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        // Configurar PDO para lançar exceções
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Verificar se o ID foi enviado
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            // Consultar o banco de dados para obter os dados do item
            $stmt = $conn->prepare("SELECT * FROM controleestoque WHERE id_estoque = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $item = $stmt->fetch();
            // Verificar se o item existe
            if ($item) {
                ?>
                <form action="processar_atualizacao.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    Nome do Produto: <input type="text" name="nome_produto" value="<?php echo $item['nomedoproduto']; ?>"><br>
                    Quantidade: <input type="text" name="quantidade" value="<?php echo $item['quantidade']; ?>"><br>
                    Preço: <input type="text" name="preco" value="<?php echo $item['preco']; ?>"><br>
                    Tipo: <input type="text" name="tipo" value="<?php echo $item['tipo']; ?>"><br>
                    Data: <input type="text" name="data" value="<?php echo $item['data']; ?>"><br>
                    Fornecedor: <input type="text" name="fornecedor" value="<?php echo $item['fornecedor']; ?>"><br>
                    <input type="submit" value="Atualizar">
                </form>
                <?php
            } else {
                echo "Item não encontrado.";
            }
        } else {
            echo "ID do item não especificado!";
        }
    } catch(PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }

    $conn = null;
    ?>
</body>
</html>

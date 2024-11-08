<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exibir Estoque</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Estoque</h2>
    <table>
        <tr>
            <th>Nome do Produto</th>
            <th>Quantidade</th>
            <th>Preço</th>
            <th>Tipo</th>
            <th>Data</th>
            <th>Fornecedor</th>
            <th>Imagem</th>
            <th>Ações</th>
        </tr>
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

            // Consultar o banco de dados
            $stmt = $conn->query("SELECT * FROM controleestoque");
            while ($row = $stmt->fetch()) {
                echo "<tr>";
                echo "<td>" . $row['nomedoproduto'] . "</td>";
                echo "<td>" . $row['quantidade'] . "</td>";
                echo "<td>" . $row['preco'] . "</td>";
                echo "<td>" . $row['tipo'] . "</td>";
                echo "<td>" . $row['data'] . "</td>";
                echo "<td>" . $row['fornecedor'] . "</td>";
                echo "<td><img src='../uploads/" . $row['imagem'] . "' width='100'></td>";
                echo "<td>
                        <form action='remover_estoque.php' method='post'>
                            <input type='hidden' name='id' value='" . $row['id_estoque'] . "'>
                            <input type='submit' value='Remover'>
                        </form>
                        <form action='atualizar_estoque.php' method='post'>
                            <input type='hidden' name='id' value='" . $row['id_estoque'] . "'>
                            <input type='submit' value='Atualizar'>
                        </form>
                      </td>";
                echo "</tr>";
            }
        } catch(PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }

        $conn = null;
        ?>
    </table>
</body>
</html>

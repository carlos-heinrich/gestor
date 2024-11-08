<?php
require 'verificar_permissao.php';

verificarPermissao([1,2,3]);
 
?>
<?php
// Configuração de conexão com o banco de dados
$host = 'localhost';
$dbname = 'bike';
$username = 'root';
$password = '';

// Conexão com o banco de dados
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar: " . $e->getMessage());
}

// Query para selecionar todas as vendas
$sql = "SELECT * FROM vendas";
$stmt = $pdo->query($sql);
$vendas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>




<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/controlefiscal.css">
    <title>Listar Vendas</title>
</head>

<body>
<style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            background-color: #ddd;
        }
    
        th,
        td {
            border: 5px solid black;
            padding: 10px;
            text-align: center;
        }
    
        th {
            background-color:#001e27;
            color: #ddd;
        }
    </style>

<div class="comeco">
        <div class="retangulo"></div>
      
    </div>

    <h1>Listar Vendas</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID Venda</th>
                <th>Produto</th>
                <th>Valor Unitário</th>
                <th>Quantidade</th>
                <th>Total</th>
                <th>Data</th>
                <th>Atualizar</th>
                <th>Deletar</th> <!-- Coluna adicional para o botão de atualizar -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vendas as $venda) : ?>
                <tr>
                    <td><?php echo $venda['id_venda']; ?></td>
                    <td><?php echo $venda['produto']; ?></td>
                    <td>R$<?php echo $venda['valor']; ?></td>
                    <td><?php echo $venda['quantidade']; ?></td>
                    <td>R$<?php echo $venda['total']; ?></td>
                    <td><?php echo $venda['data']; ?></td>
                    
                    <td><a class="button" href="atualizar_vendas.php?id=<?php echo $venda['id_venda']; ?>&produto=<?php echo $venda['produto']; ?>&valor=<?php echo $venda['valor']; ?>&quantidade=<?php echo $venda['quantidade']; ?>&total=<?php echo $venda['total']; ?>&data=<?php echo $venda['data']; ?>">Atualizar</a></td>
                    <td><a class="button" href="deletar_venda.php?id=<?php echo $venda['id_venda']; ?>">Deletar</a></td>

                    </td>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


    <div class="rodape">
    <a class="entra" href="../Portifolio/index.php">Voltar</a>
    </div>



  

</body>

</html>



<?php
require 'verificar_permissao.php';

verificarPermissao([1,2,3]);
 
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/estoque.css">
    <title>Controle de estoque</title>
</head>

<body>


<div class="comeco">
        
    </div>

   
    <h1 class="h2center">Produtos Cadastrados</h1>
    <section class="showinfo">
    <div class="table-container">
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

        // Consulta SQL para selecionar todos os registros da tabela controleestoque
        $sql = "SELECT * FROM controleestoque";

        try {
            // Preparar a consulta
            $stmt = $pdo->prepare($sql);

            // Executar a consulta
            $stmt->execute();

            // Verificar se existem registros retornados
            if ($stmt->rowCount() > 0) {
                // Exibir os dados em uma tabela
                echo "<table>
                <tr>
                    <th>Nome do Produto</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                    <th>Tipo</th>
                    <th>Data</th>
                    <th>Fornecedor</th>
                    <th>Imagem</th>
                    <th>Atualizar</th>
                    <th>Deletar</th>
                </tr>";

                // Loop através dos resultados da consulta
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row['nomedoproduto'] . "</td>";
                    echo "<td>" . $row['quantidade'] . "</td>";
                    echo "<td>" . $row['preco'] . "</td>";
                    echo "<td>" . $row['tipo'] . "</td>";
                    echo "<td>" . $row['data'] . "</td>";
                    echo "<td>" . $row['fornecedor'] . "</td>";

                    echo "<td><img src='../MVC/public/Estoque/uploads/{$row['imagem']}' width='100'></td>";
                    echo "<td><a class='conect' href='atualizar_estoque.php?id=" . $row['id_estoque'] . "'>Atualizar</a></td>";
                    echo "<td><a  class='conect' href='deletar_produto.php?id=" .   htmlspecialchars($row['id_estoque'])  . "' onclick='return confirm(\"Tem certeza que deseja deletar este produto?\")'>Deletar</a></td>";


                }

                echo "</table>";
            } else {
                echo "Nenhum registro encontrado.";
            }
        } catch (PDOException $e) {
            die("Erro ao executar a consulta: " . $e->getMessage());
        }
        ?>

    </section>
    <footer class="rodape">
    <a class="entra" href="../Portifolio/index.php">Voltar</a>
    </footer>
</body>

</html>
<?php
require 'verificar_permissao.php';

verificarPermissao([1]);
 
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/estoque.css">
    <title>Document</title>
</head>

<body>



    <div class="comeco">
        <div class="retangulo"></div>
    </div>

    <h2 class="h2center">Controle De Empresas</h2>
    <section class="showinfo">
    <div class="table-container">
        <?php
        require_once 'C:\xampp\htdocs\gestao_bikes\GB\config\config.php';

        echo "<table>";
        echo "<tr><th>Nome</th><th>Serviços</th><th>CNPJ</th><th>CEP</th><th>Estado</th><th>Rua</th><th>Número</th><th>Ações</th></tr>";

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
                echo "<td>";
                echo "<a class='conect' href='editar_empresa.php?id=" . htmlspecialchars($row['id_empresa']) . "'>Editar</a> | ";
                echo "<a  class='conect' href='deletar_empresa.php?id=" . htmlspecialchars($row['id_empresa']) . "' onclick='return confirm(\"Tem certeza que deseja deletar esta empresa?\")'>Deletar</a>";
                echo "</td>";
                echo "</tr>";
            }
        } catch (PDOException $e) {
            echo "<p>Erro ao exibir empresas: " . $e->getMessage() . "</p>";
        }

        echo "</table>";
        ?>
    </section>

    <footer class="rodape">
    <a class="entra" href="../Portifolio/index.php">Voltar</a>
    </footer>
</body>

</html>
<?php
require '../../php/verificar_permissao.php';

verificarPermissao([1, 2, 3]);
 
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
    <link rel="stylesheet" href="../../Css/estoque2.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
<div class="comeco">
      
    </div><br><br>
<div class="text">Cadastrar Produtos</div>
    <section>
        <div class="sidebar">
            <button onclick="window.location.href='../../Portifolio/index.php'">Home</button>
            <button onclick="window.location.href='../../php/controle_estoque.php'">Produtos Cadastrados</button>
        </div>
        <div class="container">
            <div class="form-container">
                <form class="formstyle" action="../public/Estoque/Resultado.php" method="POST" enctype="multipart/form-data">
                    <label for="nome_produto">Nome do Produto:</label>
                    <input type="text" id="nome_produto" name="nome_produto" required>
                    <label for="quantidade">Quantidade:</label>
                    <input type="number" id="quantidade" name="quantidade" required>
                    <label for="preco">Preço:</label>
                    <input type="number" id="preco" name="preco" step="0.01" required>
                    <label for="tipo">Tipo:</label>
                    <input type="text" id="tipo" name="tipo" required>
                    <label for="data">Data:</label>
                    <input type="date" id="data" name="data" required>
                    <label for="fornecedor">Fornecedor:</label>
                    <input type="text" id="fornecedor" name="fornecedor" required>
                    <label for="imagem">Imagem:</label>
                    <input type="file" id="imagem" name="imagem" accept="image/*" required>
                    <input type="submit" value="Cadastrar">
                </form>
            </div>
        </div>
    </section>
    <div class="rodape">
    <a class="entra" href="../../Portifolio/index.php">Voltar</a>
</body>

</html>
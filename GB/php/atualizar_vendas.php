<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Venda</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #6C7B95, #82A5A5);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.3);
            width: 90%;
            max-width: 500px;
        }

        h2 {
            color: #333;
            text-align: center;
            font-size: 36px;
            margin-bottom: 30px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        label {
            color: #333;
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"] {
            width: calc(100% - 20px);
            padding: 15px 10px;
            margin-bottom: 20px;
            border: none;
            border-radius: 25px;
            background-color: #eee;
            font-size: 18px;
            color: #333;
            outline: none;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        input[type="text"]:focus {
            background-color: #fff;
        }

        input[type="submit"] {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 25px;
            background: linear-gradient(135deg, #8CC7A1, #43ABC9);
            font-size: 20px;
            color: #fff;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        input[type="submit"]:hover {
            transform: scale(1.05);
            background: linear-gradient(135deg, #66BAB7, #3987A3);
        }
    </style>
</head>
<body>
    <div class="form-container">
        <?php
        // Verificar se todas as informações necessárias foram passadas pela URL
        if (isset($_GET['id']) && isset($_GET['produto']) && isset($_GET['valor']) && isset($_GET['quantidade']) && isset($_GET['total']) && isset($_GET['data'])) {
            // Extrair as informações da URL
            $id_venda = $_GET['id'];
            $produto = $_GET['produto'];
            $valor = $_GET['valor'];
            $quantidade = $_GET['quantidade'];
            $total = $_GET['total'];
            $data = $_GET['data'];

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar vendas</title>
    <link rel="stylesheet" href="../Css/atualizar_usuario.css">
</head>
<body>


<?php
    echo "<h2>Atualizar Venda</h2>";
    echo "<form action='atualizar_venda_processamento.php' method='POST'>";
    echo "<input type='hidden' name='id_venda' value='$id_venda'>";
    echo "<label for='produto'>Produto:</label>";
    echo "<input type='text' name='produto' value='$produto'><br>";
    echo "<label for='valor'>Valor Unitário:</label>";
    echo "<input type='text' name='valor' value='$valor'><br>";
    echo "<label for='quantidade'>Quantidade:</label>";
    echo "<input type='text' name='quantidade' value='$quantidade'><br>";
    echo "<label for='total'>Total:</label>";
    echo "<input type='' name='total' value='$total'><br>";
    echo "<label for='data'>Data:</label>";
    echo "<input type='text' name='data' value='$data'><br>";
    echo "<input type='submit' value='Atualizar'>";
    echo "</form>";
} else {
    echo "Informações da venda não especificadas.";
}
?>

</body>
</html>
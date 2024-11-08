<?php
require '../../php/verificar_permissao.php';
verificarPermissao([1, 2, 3]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Fiscal</title>
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

        section {
            display: flex;
            flex-direction: column;
        }

        button {
            width: fit-content;
            margin: 5% 0% 5% 0%;
            padding: 10px;
            border: none;
            border-radius: 20px;
            background: linear-gradient(135deg, #8CC7A1, #43ABC9);
            font-size: 15px;
            color: #fff;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button :hover {
            transform: scale(1.05);
            background: linear-gradient(135deg, #66BAB7, #3987A3);
        }

        .bttnback {
            display: flex;
            align-items: flex-start;
        }

        a {
            text-decoration: none;
            color: white;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.3);
            width: 90%;
            max-width: 500px;
        }

        h1 {
            color: #fff;
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

        input[type="text"],
        input[type="number"] {
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

        input[type="text"]:focus,
        input[type="number"]:focus {
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
    <section>
        <div class="bttnback">
            <button><a href="../../Portifolio/index.php">Voltar à página inicial</a></button>
        </div>
        <div class="form-container">
            <h1>Fatura</h1>
            <form method="post" action="../Controller/FiscalController.php" oninput="calcularCampos()">
                <label for="transacoes">Número de transações:</label>
                <input type="text" id="transacoes" name="transacoes" required><br>

                <label for="fatura">Valor da fatura:</label>
                <input type="text" id="fatura" name="fatura" required><br>

                <label for="imposto">Imposto:</label>
                <input type="text" id="imposto" name="imposto" required><br>

                <label for="orcamentos">Gasto Total:</label>
                <input type="text" id="orcamentos" name="orcamentos" required><br>

                <input type="submit" value="Enviar">
            </form>
        </div>
    </section>
</body>

</html>
<script>
    function calcularCampos() {
        let transacoes = document.getElementById('transacoes').value;
        let fatura = document.getElementById('fatura').value;
        let imposto = document.getElementById('imposto').value;

        // Exemplo de cálculo automático
        if (transacoes && fatura && imposto) {
            let orcamentos = (parseFloat(transacoes) + parseFloat(fatura) + parseFloat(imposto)).toFixed(2);
            document.getElementById('orcamentos').value = orcamentos;
        }
    }
</script>
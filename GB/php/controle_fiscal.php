<?php
require 'verificar_permissao.php';

verificarPermissao([1, 2, 3]);

// Configuração do Banco de Dados
$host = 'localhost';
$dbname = 'bike';
$username = 'root';
$password = '';

try {
    // Conexão com o Banco de Dados
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar: " . $e->getMessage());
}

// Recuperar Dados da Tabela controlefiscal
try {
    $sql = "SELECT * FROM controlefiscal";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Calcular o total dos gastos
    $totalGastos = 0;
    foreach ($dados as $dado) {
        $totalGastos += $dado['orcamentos'];
    }
} catch (PDOException $e) {
    die("Erro ao recuperar dados: " . $e->getMessage());
}


?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="../Css/controlefiscal.css">

<head>
    <meta charset="UTF-8">
    <title>Exibir Dados Fiscais</title>
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
            background-color: #001e27;
            color: #ddd;
        }

        .ver_vendas {
            color: whitesmoke;
            text-decoration: none;
            font-size: larger;
            font-weight: bold;
        }

        .button_vv {
            margin-top: 5%;
            padding: 10px 20px;
            background-color: #1F9EA7;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
    </style>


    <div class="comeco">
    
    </div>

    <h1 class="h2center">Gastos</h1>
    <table>
        <tr>
            <th>ID Fiscal</th>
            <th>Transações</th>
            <th>Fatura</th>
            <th>Imposto</th>
            <th>Gasto Total</th>
            <th>Atualizar</th>
            <th>Excluir</th>
            <th>Pagar Faturas</th>
        </tr>
        <?php foreach ($dados as $dado) : ?>
            <tr>
                <td><?php echo htmlspecialchars($dado['id_fiscal']); ?></td>
                <td>R$<?php echo htmlspecialchars($dado['transacoes']); ?></td>
                <td>R$<?php echo htmlspecialchars($dado['fatura']); ?></td>
                <td>R$<?php echo htmlspecialchars($dado['imposto']); ?></td>
                <td>R$<?php echo htmlspecialchars($dado['orcamentos']); ?></td>
                <td><a class="button" href="atualizar_gastos.php?id=<?php echo $dado['id_fiscal']; ?>">Atualizar</a></td>
                <td><a class="button" href="excluir_registro.php?id=<?php echo $dado['id_fiscal']; ?>">Excluir</a></td>
                <td></td>



            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="4"><strong>Total de Gastos:</strong></td>
            <td><strong>R$<?php echo htmlspecialchars(number_format($totalGastos, 2, ',', '.')); ?></strong></td>
            <td colspan="2"></td>

            <td><a class="button" href="boleto-pdf.php?id=<?php echo $dado['id_fiscal']; ?>">Gerar Boleto</a></td>

        </tr>
    </table>
    <button class="button_vv"> <a class="ver_vendas" href="controle_vendas.php"> Ver Vendas </a></button>

    <div class="rodape">
        <a class="entra" href="../Portifolio/index.php">Voltar</a>
    </div>


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
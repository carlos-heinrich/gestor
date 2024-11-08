<?php
require 'verificar_permissao.php';

// Verifica se o usuário tem permissão para acessar esta página
verificarPermissao([1, 2, 3]);

// Verifica se o ID fiscal foi fornecido na URL
if (isset($_GET['id'])) {
    // Captura o ID fiscal fornecido na URL
    $id_fiscal = $_GET['id'];

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

    // Verifica se o formulário foi submetido
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Processa os dados do formulário
        $transacoes = $_POST['transacoes'];
        $fatura = $_POST['fatura'];
        $imposto = $_POST['imposto'];
        $orcamentos = $_POST['orcamentos'];

        // Query de atualização
        $sql = "UPDATE controlefiscal SET transacoes = :transacoes, fatura = :fatura, imposto = :imposto, orcamentos = :orcamentos WHERE id_fiscal = :id";

        // Preparar e executar a declaração de atualização
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':transacoes', $transacoes);
        $stmt->bindParam(':fatura', $fatura);
        $stmt->bindParam(':imposto', $imposto);
        $stmt->bindParam(':orcamentos', $orcamentos);
        $stmt->bindParam(':id', $id_fiscal);
        $stmt->execute();

        // Redireciona de volta para a página anterior após a atualização
        header("Location: controle_fiscal.php");
        exit();
    }

    // Recuperar Dados do registro correspondente ao ID fiscal
    try {
        $sql = "SELECT * FROM controlefiscal WHERE id_fiscal = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id_fiscal, PDO::PARAM_INT);
        $stmt->execute();
        $dados_fiscais = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erro ao recuperar dados: " . $e->getMessage());
    }
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="../Css/estoque.css">
<head>
<body>
<div class="comeco">
        <h1 class="titulo"> Sistema De Gestão ERP+controle de empresas e de pessoas </h1>
        <a href="../Portifolio/index.php"><img class="logo" src="../Img/bitrix-removebg-preview.png"></a>
    </div><br><br>

    <section>
        <div class="sidebar">
            <button onclick="window.location.href='../Portifolio/index.php'">Home</button>
      
        </div>
        <div class="container">
            <div class="form-container">
     
    <meta charset="UTF-8">
    <title>Atualizar Gastos</title>


    <form class="formstyle" method="post" action="processar_atualizar.php" oninput="calcularCampos()">
    <form id="formAtualizar" method="post">
        <input type="hidden" name="id" value="<?php echo $id_fiscal; ?>">
        <label for="transacoes">Transações:</label><br>
        <input type="number" id="transacoes" name="transacoes" value="<?php echo $dados_fiscais['transacoes']; ?>"><br>
        <label for="fatura">Fatura:</label><br>
        <input type="number" id="fatura" name="fatura" value="<?php echo $dados_fiscais['fatura']; ?>"><br>
        <label for="imposto">Imposto:</label><br>
        <input type="number" id="imposto" name="imposto" value="<?php echo $dados_fiscais['imposto']; ?>"><br>
        <label for="orcamentos">Gasto Total:</label><br>
        <input type="text" id="orcamentos" name="orcamentos" value="<?php echo $dados_fiscais['orcamentos']; ?>"><br><br>
        <input type="submit" value="Atualizar" onclick="submitForm()">
    </form>

    <script>
        function submitForm() {
            // Adiciona o atributo action ao formulário
            document.getElementById("formAtualizar").action = "processar_atualizar.php";
        }
    </script>
</body>
</html>

</body>
</html>

<?php
} else {
    // Se o ID fiscal não foi fornecido, redirecione de volta para a página anterior
    header("Location: controle_fiscal.php");
    exit();
}
?>
<script>
        function calcularCampos() {
            let transacoes = document.getElementById('transacoes').value;
            let fatura = document.getElementById('fatura').value;
            let imposto = document.getElementById('imposto').value;

            // Exemplo de cálculo automático
            if(transacoes && fatura && imposto) {
                let orcamentos = (parseFloat(transacoes) + parseFloat(fatura) + parseFloat(imposto)).toFixed(2);
                document.getElementById('orcamentos').value = orcamentos;
            }
        }
    </script>
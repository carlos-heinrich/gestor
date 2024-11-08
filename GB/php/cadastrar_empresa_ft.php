<?php
require_once 'C:\xampp\htdocs\gestao_bikes\GB\config\config.php';

// Recebe os dados do formulário e processa o cadastro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $servicos = $_POST['servicos'];
    $cnpj = $_POST['cnpj'];
    $senha_emp = $_POST['senha_emp'];
    $cep = $_POST['cep'];
    $estado = $_POST['estado'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];

    // Lógica para inserir os dados no banco de dados
    try {
        $stmt = $pdo->prepare("INSERT INTO cadastro_empresa (nome, servicos, cnpj, senha_emp, cep, estado, rua, numero) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nome, $servicos, $cnpj, $senha_emp, $cep, $estado, $rua, $numero]);


    } catch (PDOException $e) {
        echo "Erro ao cadastrar empresa: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de empresa</title>
</head>
<body>
 

<div id="loading-screen">
    <div class="spinner"></div>
    <div class="loading-text">Loading...</div>
</div>


<script src="../JS/script.js"></script>





<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Empresas</title>
 

</head>

<body>
    

    <section>
        <div class="sidebar">
            <button onclick="window.location.href='index.php'">Home</button>
            <button onclick="window.location.href='login_empresa.php'">  Login de empresas  </button>
        </div>

        <div class="container">

            <div class="form-container">
                <div class="text">Cadastrar Empresas</div>

                <form class="formstyle" method="post">
                    <label for="nome">Nome da Empresa:</label><br>
                    <input type="text" id="nome" name="nome" required><br>

                    <label for="servicos">Serviços:</label><br>
                    <input type="text" id="servicos" name="servicos" required><br>

                    <label for="cnpj">CNPJ:</label><br>
                    <input type="text" id="cnpj" name="cnpj" required><br>

                    <label for="cnpj">Senha:</label><br>
                    <input type="password" id="senha_emp" name="senha_emp" required><br>

                    <label for="cep">CEP:</label><br>
                    <input type="text" id="cep" name="cep" required><br><br>
                    <button class="bttngradient" type="button" onclick="consultarCEP()">Consultar</button><br><br>

                    <label for="estado">Estado:</label><br>
                    <input type="text" id="estado" name="estado" readonly><br>

                    <label for="rua">Rua:</label><br>
                    <input type="text" id="rua" name="rua" readonly><br>

                    <label for="numero">Número:</label><br>
                    <input type="text" id="numero" name="numero" required><br><br>

                    <button class="bttngradient" type="submit" value="Cadastrar">cadastrar</button>
                </form>

            </div>
        </div>
    </section>


    <div class="rodape">
        <a class="entra" href="index.php">Voltar</a>
        <div>
</body>

<script>
    function consultarCEP() {
        var cep = document.getElementById('cep').value;
        var url = 'https://viacep.com.br/ws/' + cep + '/json/';

        fetch(url)
            .then(response => response.json())
            .then(data => {
                if (data.erro) {
                    alert('CEP não encontrado.');
                } else {
                    document.getElementById('estado').value = data.uf;
                    document.getElementById('rua').value = data.logradouro;
                }
            })
            .catch(error => {
                console.error('Erro ao consultar o CEP:', error);
                alert('Erro ao consultar o CEP.');
            });
    }
</script>

</html>
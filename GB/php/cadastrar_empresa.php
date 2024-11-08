<?php
require 'verificar_permissao.php';

verificarPermissao([1]);

?>

<style>
    #loading-screen {
        position: fixed;
        width: 100%;
        height: 100%;
        background-color: black;
        ;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        z-index: 1000;
 
    }

    .spinner {
        border: 16px solid #f3f3f3;
        border-top: 16px solid #3498db;
        border-radius: 50%;
        width: 120px;
        height: 120px;
        animation: spin 2s linear infinite, color-change 3s infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    @keyframes color-change {
        0% {
            border-top-color: #3498db;
        }

        25% {
            border-top-color: #e74c3c;
        }

        50% {
            border-top-color: #f1c40f;
        }

        75% {
            border-top-color: #2ecc71;
        }

        100% {
            border-top-color: #3498db;
        }
    }

    .loading-text {
        margin-top: 20px;
        font-size: 24px;
        color: #fff;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 2px;
        animation: color-text-change 3s infinite;
    }

    @keyframes color-text-change {
        0% {
            color: #3498db;
        }

        25% {
            color: #e74c3c;
        }

        50% {
            color: #f1c40f;
        }

        75% {
            color: #2ecc71;
        }

        100% {
            color: #3498db;
        }
    }

    #content {
        display: none;
        padding: 20px;
        text-align: center;
    }

    h1 {
        font-size: 48px;
        margin: 20px 0;
    }

    p {
        font-size: 24px;
    }

    .bttngradient  {
    background: linear-gradient(45deg, #6a11cb, #2575fc);
    color: white;
    padding: 15px 20px;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    width: 100%;
    font-size: 18px;
    font-weight: bold;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
    text-transform: uppercase;
}

.bttngradient:hover {
    background: linear-gradient(45deg, #2575fc, #6a11cb);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
    transform: translateY(-2px);
}

.bttngradient:active {
    transform: translateY(1px);
}

    


</style>

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
    <div class="comeco">

    </div><br><br>

    <section>
        <div class="sidebar">
            <button onclick="window.location.href='../Portifolio/index.php'">Home</button>
            <button onclick="window.location.href='../php/controle_empresa.php'">Empresas Cadastradas</button>
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
    <a class="entra" href="../Portifolio/index.php">Voltar</a>
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

        echo "Empresa cadastrada com sucesso!";
        header('login_empresa.php');
    } catch (PDOException $e) {
        echo "Erro ao cadastrar empresa: " . $e->getMessage();
    }
}
?>
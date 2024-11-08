
    <?php
    require_once 'C:\xampp\htdocs\gestao_bikes\GB\config\config.php';

    $id_empresa = $_GET['id'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM cadastro_empresa WHERE id_empresa = ?");
        $stmt->execute([$id_empresa]);
        $empresa = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$empresa) {
            echo "<p>Empresa não encontrada.</p>";
            exit;
        }
    } catch (PDOException $e) {
        echo "<p>Erro ao buscar empresa: " . $e->getMessage() . "</p>";
        exit;
    }
    ?>




<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Editar Empresas</title>
    <link rel="stylesheet" href="../Css/estoque.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>

<style>
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


<div class="comeco">
        <h1 class="titulo"> Sistema De Gestão ERP+controle de empresas e de pessoas </h1>
        <a href="../Portifolio/index.php"><img class="logo" src="../Img/bitrix-removebg-preview.png"></a>
    </div><br><br>
    <section>
        <div class="sidebar">
            <button onclick="window.location.href='../Portifolio/index.php'">Home</button>
            <button onclick="window.location.href='../php/controle_empresa.php'">Controle de empresas</button>
        </div>
        <div class="container">
            <div class="text">Editar empresas</div>
            <div class="form-container">
           
        <form class="formstyle" id="formEmpresa" action="atualizar_empresa.php" method="post">
            <input type="hidden" name="id_empresa" value="<?php echo htmlspecialchars($empresa['id_empresa']); ?>">
    
            <label for="nome">Nome da Empresa:</label>
            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($empresa['nome']); ?>" required>
    
            <label for="servicos">Serviços:</label>
            <input type="text" id="servicos" name="servicos"
                value="<?php echo htmlspecialchars($empresa['servicos']); ?>" required>
    
            <label for="cnpj">CNPJ:</label>
            <input type="text" id="cnpj" name="cnpj" value="<?php echo htmlspecialchars($empresa['cnpj']); ?>" required>
    
            <label for="cnpj">Senha:</label>
            <input type="text" id="senha_emp" name="senha_emp"
                value="<?php echo htmlspecialchars($empresa['senha_emp']); ?>" required>
    
            <label for="cep">CEP:</label>
            <input type="text" id="cep" name="cep" value="<?php echo htmlspecialchars($empresa['cep']); ?>" required>
            <button class="bttngradient" type="button" onclick="consultarCEP()">Consultar</button>
    
            <label for="estado">Estado:</label>
            <input type="text" id="estado" name="estado" value="<?php echo htmlspecialchars($empresa['estado']); ?>"
                readonly>
    
            <label for="rua">Rua:</label>
            <input type="text" id="rua" name="rua" value="<?php echo htmlspecialchars($empresa['rua']); ?>" readonly>
    
            <label for="numero">Número:</label>
            <input type="text" id="numero" name="numero" value="<?php echo htmlspecialchars($empresa['numero']); ?>"
                required>
    
            <button class="bttngradient" type="submit">Atualizar</button>
        </form>
            </div>
        </div>
    </section>

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






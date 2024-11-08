<?php
session_start();
require_once '../config/config.php';
require_once '../MVC/Controller/EmpresaController.php';
require_once '../MVC/Model/EmpresaModel.php';


if (isset($_POST['cnpj']) && isset($_POST['senha_emp'])) {
    $cnpj = $_POST['cnpj'];
    $senha_emp = $_POST['senha_emp'];

    $sql_code = $pdo->prepare("SELECT * FROM cadastro_empresa WHERE cnpj = ? AND senha_emp = ?");
    $sql_code->execute([$cnpj, $senha_emp]);

    $quantidade = $sql_code->rowCount();



    if ($quantidade > 0) {
        $pdo = $sql_code->fetch(PDO::FETCH_ASSOC);


        $_SESSION['id_empresa'] = $pdo['id_empresa'];
        $_SESSION['nome'] = $pdo['nome'];
        $_SESSION['cnpj'] = $pdo['cnpj'];

        header('Location: ../php/login.php');
    } else {
        echo '
            <script>
                function verificarCondicao() {
                    var condicao = true;
                    if (condicao) {
                        exibirCaixaDialogo();
                    }
                }
                function exibirCaixaDialogo() {
                    var resposta = confirm("Algumas credenciais estão incorretas, tente novamente!");
                    if (resposta == true) {
                    
                    } else {
                }
            }
                window.onload = verificarCondicao;
            </script>
        ';
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Empresa</title>
   
</head>

<body>
    <div class="comeco">
       
    
        
        <div class="center_form ">
        <div class="textoo">Login Empresa</div>
        <form method="post">
      
            <label for="cnpj">CNPJ:</label><br>
            <input type="text" id="cnpj" name="cnpj" required><br>

            <label for="nome">Senha:</label><br>
            <input type="password" id="senha_emp" name="senha_emp" required><br>

            <button type="submit" name="signin"> Entrar </button>

            <p> Sua empresa ainda não tem conta? Realize o <a href="cadastrar_empresa_ft.php"> Cadastro </a></p>
        </form>
        </div>
    </section>

    <div class="rodape">
    <a class="entra" href="index.php">Voltar</a>
<div>


</body>
</html>
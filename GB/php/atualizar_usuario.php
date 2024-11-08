
<?php
include_once('../config/config.php');

// Verifica se o ID do usuário foi passado via GET
if(isset($_GET['id'])) {
    $id_usuario = $_GET['id'];
    
    // Consulta ao banco de dados para obter as informações do usuário com o ID fornecido
    $sql_code = $pdo->prepare("SELECT * FROM usuarios WHERE id_user = ?");
    $sql_code->execute(array($id_usuario));
    $usuario = $sql_code->fetch(PDO::FETCH_ASSOC);

    // Verifica se o formulário foi submetido
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verifica se todos os campos do formulário foram preenchidos
        if (isset($_POST['nome_completo']) && isset($_POST['nome_usuario']) && isset($_POST['datadenascimento']) && isset($_POST['cpf']) && isset($_POST['genero']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['tipo_funcionario']) && isset($_POST['cep']) && isset($_POST['cidade']) && isset($_POST['rua']) && isset($_POST['numero']) && isset($_POST['complemento']) && isset($_POST['hora_entrada']) && isset($_POST['hora_saida']) && isset($_POST['carga_horaria']) && isset($_POST['remuneracao']) && isset($_POST['data_contratacao'])) {
            
            // Atualize os dados do usuário no banco de dados
            $sql_code = $pdo->prepare("UPDATE usuarios SET nome_completo=?, nome_usuario=?, datadenascimento=?, cpf=?, genero=?, phone=?, email=?, tipo_funcionario=?, cep=?, cidade=?, rua=?, numero=?, complemento=?, hora_entrada=?, hora_saida=?, carga_horaria=?, remuneracao=?, data_contratacao=? WHERE id_user=?");

            $sql_code->execute(array($_POST['nome_completo'], $_POST['nome_usuario'], $_POST['datadenascimento'], $_POST['cpf'], $_POST['genero'], $_POST['phone'], $_POST['email'], $_POST['tipo_funcionario'], $_POST['cep'], $_POST['cidade'], $_POST['rua'], $_POST['numero'], $_POST['complemento'], $_POST['hora_entrada'], $_POST['hora_saida'], $_POST['carga_horaria'], $_POST['remuneracao'], $_POST['data_contratacao'], $id_usuario));

            // Redirecione de volta para a página de exibição de usuários
            header("Location: gestaorh.php");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../GB/Css/atualizar_usuario.css">
    <title>Atualizar Usuário</title>
</head>
<body>
    <header>
 
        <h1>Atualizar Usuário</h1>
    </header>
    


<div class="menu-bg" id="menu-bg"></div>

<script>
  function menuOnClick() {
    document.getElementById("menu-bar").classList.toggle("change");
    document.getElementById("nav").classList.toggle("change");
    document.getElementById("menu-bg").classList.toggle("change-bg");
  }
</script>
    <main>
        <form method="post" >
            <input type="hidden" name="id" value="<?php echo $usuario['id_user']; ?>">

            <!-- Form fields -->
            <label for="nome_completo">Nome Completo:</label>
            <input type="text" name="nome_completo" value="<?php echo $usuario['nome_completo']; ?>"><br>
            
            <label for="nome_usuario">Nome de Usuário:</label>
            <input type="text" name="nome_usuario" value="<?php echo $usuario['nome_usuario']; ?>"><br>
            
            <label for="datadenascimento">Data de Nascimento:</label>
            <input type="date" name="datadenascimento" value="<?php echo $usuario['datadenascimento']; ?>"><br>
            
            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" value="<?php echo $usuario['cpf']; ?>"><br>
            
            <label for="genero">Gênero:</label>
            <input type="text" name="genero" value="<?php echo $usuario['genero']; ?>"><br>
            
            <label for="phone">Telefone:</label>
            <input type="text" name="phone" value="<?php echo $usuario['phone']; ?>"><br>
            
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo $usuario['email']; ?>"><br>
            
            <label for="tipo_funcionario">Tipo de Funcionário:</label>
            <input type="text" name="tipo_funcionario" value="<?php echo $usuario['tipo_funcionario']; ?>"><br>
            
            <label for="cep">CEP:</label>
            <input type="text" name="cep" value="<?php echo $usuario['cep']; ?>"><br>
            
            <label for="cidade">Cidade:</label>
            <input type="text" name="cidade" value="<?php echo $usuario['cidade']; ?>"><br>
            
            <label for="rua">Rua:</label>
            <input type="text" name="rua" value="<?php echo $usuario['rua']; ?>"><br>
            
            <label for="numero">Número:</label>
            <input type="text" name="numero" value="<?php echo $usuario['numero']; ?>"><br>
            
            <label for="complemento">Complemento:</label>
            <input type="text" name="complemento" value="<?php echo $usuario['complemento']; ?>"><br>
            
            <label for="hora_entrada">Hora de Entrada:</label>
            <input type="time" name="hora_entrada" value="<?php echo $usuario['hora_entrada']; ?>"><br>
            
            <label for="hora_saida">Hora de Saída:</label>
            <input type="time" name="hora_saida" value="<?php echo $usuario['hora_saida']; ?>"><br>
            
            <label for="carga_horaria">Carga Horária:</label>
            <input type="text" name="carga_horaria" value="<?php echo $usuario['carga_horaria']; ?>"><br>
            
            <label for="remuneracao">Remuneração:</label>
            <input type="text" name="remuneracao" value="<?php echo $usuario['remuneracao']; ?>"><br>
            
            <label for="data_contratacao">Data de Contratação:</label>
            <input type="date" name="data_contratacao" value="<?php echo $usuario['data_contratacao']; ?>"><br>
            
            <label for="foto_perfil">Foto de Perfil:</label>
            <input type="text" name="foto_perfil" value="<?php echo $usuario['foto_perfil']; ?>"><br>
            
            <input type="submit" value="Atualizar">
        </form>
    </main>
</body>
</html>

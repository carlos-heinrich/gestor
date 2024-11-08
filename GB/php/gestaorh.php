<?php
require 'verificar_permissao.php';

verificarPermissao([1, 4]);

?>




<?php


include_once ('../config/config.php');
include_once ('../MVC/Controller/UserController.php');
require_once ('../MVC/Model/UserModel.php');

$sql_code = $pdo->prepare("SELECT * FROM usuarios");
$sql_code->execute();
$pessoas = $sql_code->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (
    isset($_POST['id']) && isset($_POST['nome_completo']) && isset($_POST['nome_usuario']) &&
    isset($_POST['datadenascimento']) && isset($_POST['cpf']) && isset($_POST['genero']) &&
    isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['tipo_funcionario']) &&
    isset($_POST['cep']) && isset($_POST['cidade']) && isset($_POST['rua']) &&
    isset($_POST['numero']) && isset($_POST['complemento']) && isset($_POST['hora_entrada']) &&
    isset($_POST['hora_saida']) && isset($_POST['carga_horaria']) && isset($_POST['remuneracao']) &&
    isset($_POST['data_contratacao'])
  ) {
    $sql_code = $pdo->prepare(
      "UPDATE usuarios SET 
      nome_completo=?, nome_usuario=?, datadenascimento=?, cpf=?, genero=?, phone=?, email=?, 
      tipo_funcionario=?, cep=?, cidade=?, rua=?, numero=?, complemento=?, hora_entrada=?, 
      hora_saida=?, carga_horaria=?, remuneracao=?, data_contratacao=? WHERE id_user=?"
    );

    $sql_code->execute([
      $_POST['nome_completo'],
      $_POST['nome_usuario'],
      $_POST['datadenascimento'],
      $_POST['cpf'],
      $_POST['genero'],
      $_POST['phone'],
      $_POST['email'],
      $_POST['tipo_funcionario'],
      $_POST['cep'],
      $_POST['cidade'],
      $_POST['rua'],
      $_POST['numero'],
      $_POST['complemento'],
      $_POST['hora_entrada'],
      $_POST['hora_saida'],
      $_POST['carga_horaria'],
      $_POST['remuneracao'],
      $_POST['data_contratacao'],
      $_POST['id']
    ]);

    header("Location: gestaorh.php");
    exit();
  }
}
?>


<?php

// CADASTRO

if (isset($_POST['submit'])) {
  $nome_completo = $_POST['nome_completo'];
  $nome_usuario = $_POST['nome_usuario'];
  $datadenascimento = $_POST['datadenascimento'];
  $cpf = $_POST['cpf'];
  $genero = $_POST['genero'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $senha = $_POST['senha'];
  $tipo_funcionario = $_POST['tipo_funcionario'];
  $cep = $_POST['cep'];
  $cidade = $_POST['cidade'];
  $rua = $_POST['rua'];
  $numero = $_POST['numero'];
  $complemento = $_POST['complemento'];
  $hora_entrada = $_POST['hora_entrada'];
  $hora_saida = $_POST['hora_saida'];
  $carga_horaria = $_POST['carga_horaria'];
  $remuneracao = $_POST['remuneracao'];
  $data_contratacao = $_POST['data_contratacao'];
  $foto_perfil = $_POST['foto_perfil'];

  if ($_FILES['foto_perfil']['name']) {
    $img_nome = $_FILES['foto_perfil']['name'];
    $img_tmp = $_FILES['foto_perfil']['tmp_name'];

    $upload_dir = 'C:/xampp/htdocs/gestao_bikes/GB/uploads/';
    $destination = $upload_dir . $img_nome;
    move_uploaded_file($img_tmp, $destination);
  }

  $stmt = $pdo->prepare('SELECT COUNT(*) FROM usuarios WHERE nome_completo = :nome_completo AND nome_usuario = :nome_usuario AND email = :email AND senha = :senha');
  $stmt->execute([
    'nome_completo' => $nome_completo,
    'nome_usuario' => $nome_usuario,
    'email' => $email,
    'senha' => $senha
  ]);
  $count = $stmt->fetchColumn();

  if ($count > 0) {
    echo 'Esse perfil já foi cadastrado.';
  } else {
    $userController = new usuarioController($pdo);

    $userController->criarUser(
      $nome_completo,
      $nome_usuario,
      $datadenascimento,
      $cpf,
      $genero,
      $phone,
      $email,
      $senha,
      $tipo_funcionario,
      $cep,
      $cidade,
      $rua,
      $numero,
      $complemento,
      $hora_entrada,
      $hora_saida,
      $carga_horaria,
      $remuneracao,
      $data_contratacao,
      $img_nome
    );
    header("Location: gestaorh.php");
  }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../Css/gestaorh.css">
  <link rel="stylesheet" href="../Css/estoque.css">
  <title>GESTÃO DE BIKES</title>
</head>

<body>

  <div class="comeco">
    
  </div>
  <div class="textoo">Gestão de RH</div>
  <section class="rhcadastro">
    <div class="container">
      <div class="form-container">
        <form class="formstyle" id="a-form" method="post" enctype="multipart/form-data">
          <input class="form__input" type="text" id="nome_completo" placeholder="Nome completo" name="nome_completo"
            required> <br>
          <input class="form__input" type="text" id="nome_usuario" placeholder="Nome de usuário" name="nome_usuario"
            required> <br>
          <input class="form__input" type="date" id="datadenascimento" placeholder="Data de nascimento"
            name="datadenascimento" required> <br>
          <input class="form__input" type="text" id="cpf" placeholder="CPF" name="cpf" required> <br>

          <label for="genero">Gênero</label>
          <select id="genero" placeholder="Gênero" name="genero" placeholder="Gênero" required> <br>
            <option value="Masculino">Masculino</option>
            <option value="Feminino">Feminino</option>
            <option value="Outro">Outro</option>
          </select><br>

          <input class="form__input" type="text" id="phone" placeholder="Número de telefone" name="phone" required> <br>
          <input class="form__input" type="email" id="email" placeholder="Email" name="email" required> <br>
          <input class="form__input" type="password" id="senha" placeholder="Senha" name="senha" required> <br>
          <input id="tipo_funcionario" name="tipo_funcionario" placeholder="Categoria de funcionário" required> <br>
          <input class="form__input" type="text" id="cep" placeholder="CEP" name="cep" required> <br>
          <input class="form__input" type="text" id="cidade" placeholder="Cidade" name="cidade" required> <br>
          <input class="form__input" type="text" id="rua" placeholder="Rua" name="rua" required> <br>
          <input class="form__input" type="text" id="numero" placeholder="Número" name="numero" required> <br>
          <input class="form__input" type="text" id="complemento" placeholder="Complemento" name="complemento" required>
          <br>
          <label for="hora_entrada">Hora de entrada</label>
          <input class="form__input" type="time" id="hora_entrada" name="hora_entrada" required> <br>
          <label for="hora_saida">Hora de saída</label>
          <input class="form__input" type="time" id="hora_saida" name="hora_saida" required> <br>
          <label for="carga_horaria">Carga horária</label>
          <input class="form__input" type="text" id="carga_horaria" name="carga_horaria" required> <br>
          <label for="remuneracao">Remuneração</label>
          <input class="form__input" type="text" id="remuneracao" name="remuneracao" required> <br>
          <input class="form__input" type="date" id="data_contratacao" name="data_contratacao" required> <br>
          <label for="foto_perfil">Foto de perfil</label>
          <input type="file" id="foto_perfil" name="foto_perfil" accept="image/*">


          <button type='submit' name="submit" value="cadastrar">CADASTRAR</button>
        </form>
      </div>
    </div>
    <br><br><br>
    <div>
      <h1 class="h2center">Pessoas Cadastradas</h1>
      <div class="pessoas-container">
        <?php foreach ($pessoas as $pessoa): ?>
          <div class="pessoa">
            <div><strong>ID:</strong> <?php echo $pessoa['id_user']; ?></div>
            <div><strong>Nome Completo:</strong> <?php echo $pessoa['nome_completo']; ?></div>
            <div><strong>Nome de Usuário:</strong> <?php echo $pessoa['nome_usuario']; ?></div>
            <div><strong>Data de Nascimento:</strong> <?php echo $pessoa['datadenascimento']; ?></div>
            <div><strong>CPF:</strong> <?php echo $pessoa['cpf']; ?></div>
            <div><strong>Gênero:</strong> <?php echo $pessoa['genero']; ?></div>
            <div><strong>Telefone:</strong> <?php echo $pessoa['phone']; ?></div>
            <div><strong>Email:</strong> <?php echo $pessoa['email']; ?></div>
            <div><strong>Senha:</strong> <?php echo $pessoa['senha']; ?></div>
            <div><strong>Tipo de Funcionário:</strong> <?php echo $pessoa['tipo_funcionario']; ?></div>
            <div><strong>CEP:</strong> <?php echo $pessoa['cep']; ?></div>
            <div><strong>Cidade:</strong> <?php echo $pessoa['cidade']; ?></div>
            <div><strong>Rua:</strong> <?php echo $pessoa['rua']; ?></div>
            <div><strong>Número:</strong> <?php echo $pessoa['numero']; ?></div>
            <div><strong>Complemento:</strong> <?php echo $pessoa['complemento']; ?></div>
            <div><strong>Hora de Entrada:</strong> <?php echo $pessoa['hora_entrada']; ?></div>
            <div><strong>Hora de Saída:</strong> <?php echo $pessoa['hora_saida']; ?></div>
            <div><strong>Carga Horária:</strong> <?php echo $pessoa['carga_horaria']; ?></div>
            <div><strong>Remuneração:</strong> <?php echo $pessoa['remuneracao']; ?></div>
            <div><strong>Data de Contratação:</strong> <?php echo $pessoa['data_contratacao']; ?></div>
            <div><strong>Foto de Perfil:</strong> <?php echo $pessoa['foto_perfil']; ?></div>
            <div>
              <form action="deletar_usuario.php">
                <input type="hidden" name="id_user" value="<?php echo $pessoa['id_user']; ?>">
                <button class="deletebttn" type="submit">Deletar</button>
              </form>
            </div>
            <div><button class="atualizabttn"><a class="conect" href="atualizar_usuario.php?id=<?php echo $pessoa['id_user']; ?>">Atualizar</a></button></div>
          </div>
        <?php endforeach; ?>
      </div>
  </section>
  </div>
  <script>
    function menuOnClick() {
      document.getElementById("menu-bar").classList.toggle("change");
      document.getElementById("nav").classList.toggle("change");
      document.getElementById("menu-bg").classList.toggle("change-bg");
    }
  </script>
  <div class="rodape">
    <a class="entra" href="../Portifolio/index.php">Voltar</a>
  </div>
</body>

</html>
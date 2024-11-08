<?php
// Verifica se o ID da venda foi passado na URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Redireciona de volta para a página de listagem de vendas se o ID não estiver presente
    header("Location: listar_vendas.php");
    exit();
}

// ID da venda a ser editada
$id_venda = $_GET['id'];

// Verifica se o formulário foi submetido para salvar as alterações
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Processar os dados do formulário e atualizar a venda no banco de dados

    // Aqui você pode adicionar a lógica para atualizar os dados da venda no banco de dados
    // É importante validar e sanitizar os dados do formulário antes de salvar no banco de dados

    // Redireciona de volta para a página de listagem de vendas após a atualização
    header("Location: listar_vendas.php");
    exit();
}

// Caso contrário, recuperar os dados da venda do banco de dados para exibir no formulário de edição
// Configuração de conexão com o banco de dados
$host = 'localhost';
$dbname = 'bike';
$username = 'root';
$password = '';

// Conexão com o banco de dados
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar: " . $e->getMessage());
}

// Consulta para obter os detalhes da venda com base no ID
$sql = "SELECT * FROM vendas WHERE id_venda = :id_venda";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id_venda', $id_venda, PDO::PARAM_INT);
$stmt->execute();
$venda = $stmt->fetch(PDO::FETCH_ASSOC);

// Verifica se a venda existe
if (!$venda) {
    // Redireciona de volta para a página de listagem de vendas se a venda não for encontrada
    header("Location: listar_vendas.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Venda</title>
</head>
<body>
    <h1>Editar Venda</h1>
    <form method="POST">
        <input type="hidden" name="id_venda" value="<?php echo $venda['id_venda']; ?>">
        <label for="produto">Produto:</label>
        <input type="text" id="produto" name="produto" value="<?php echo $venda['produto']; ?>"><br>
        <label for="valor">Valor Unitário:</label>
        <input type="text" id="valor" name="valor" value="<?php echo $venda['valor']; ?>"><br>
        <label for="quantidade">Quantidade:</label>
        <input type="text" id="quantidade" name="quantidade" value="<?php echo $venda['quantidade']; ?>"><br>
        <label for="total">Total:</label>
        <input type="text" id="total" name="total" value="<?php echo $venda['total']; ?>"><br>
        <label for="data">Data:</label>
        <input type="text" id="data" name="data" value="<?php echo $venda['data']; ?>"><br>
        <input type="submit" value="Salvar Alterações">
    </form>
</body>
</html>

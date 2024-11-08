<?php
require_once '../..//Model/EstoqueModel.php';

class ControleEstoqueController {
    private $model;

    public function __construct() {
        $this->model = new ControleEstoqueModel($this->getConnection());
    }

    private function getConnection() {
        $host = 'localhost';
        $dbname = 'bike';
        $username = 'root';
        $password = '';

        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch(PDOException $e) {
            echo "Erro na conexão: " . $e->getMessage();
        }
    }

    public function cadastrarProduto($dados_produto) {
        $nome_produto = $dados_produto['nome_produto'];
        $quantidade = $dados_produto['quantidade'];
        $preco = $dados_produto['preco'];
        $tipo = $dados_produto['tipo'];
        $data = $dados_produto['data'];
        $fornecedor = $dados_produto['fornecedor'];
        $imagem = $_FILES['imagem']['name'];
        $imagem_tmp = $_FILES['imagem']['tmp_name'];

        move_uploaded_file($imagem_tmp, "../../public/Estoque/uploads/$imagem");

        if($this->model->cadastrarProduto($nome_produto, $quantidade, $preco, $tipo, $data, $fornecedor, $imagem)) {
            echo "<h1> Cadastro realizado com sucesso! </h1>";
            header('Location: ../../Views/EstoqueViews.php');
        } else {
            echo "<h1> Erro ao cadastrar produto! </h1>";
        }
    }
}

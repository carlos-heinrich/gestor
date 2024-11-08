<?php
class ControleEstoqueModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function cadastrarProduto($nome_produto, $quantidade, $preco, $tipo, $data, $fornecedor, $imagem) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO controleestoque (nomedoproduto, quantidade, preco, tipo, data, fornecedor, imagem) VALUES (:nome_produto, :quantidade, :preco, :tipo, :data, :fornecedor, :imagem)");

            $stmt->bindParam(':nome_produto', $nome_produto);
            $stmt->bindParam(':quantidade', $quantidade);
            $stmt->bindParam(':preco', $preco);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->bindParam(':data', $data);
            $stmt->bindParam(':fornecedor', $fornecedor);
            $stmt->bindParam(':imagem', $imagem);

            $stmt->execute();

            return true;
        } catch(PDOException $e) {
            return false;
        }
    }
}
?>
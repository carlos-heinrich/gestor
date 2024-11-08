<?php
class Venda {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function criarVenda($produto, $valor, $quantidade, $data) {
        $total = $valor * $quantidade;
        $sql = "INSERT INTO vendas (produto, valor, quantidade, total, data) VALUES (:produto, :valor, :quantidade, :total, :data)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':produto' => $produto,
            ':valor' => $valor,
            ':quantidade' => $quantidade,
            ':total' => $total,
            ':data' => $data
        ]);
    }
}
?>

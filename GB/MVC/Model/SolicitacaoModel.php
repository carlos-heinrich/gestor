<?php
class Solicitacao {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->createTable();
    }

    private function createTable() {
        $createTableSQL = "
            CREATE TABLE IF NOT EXISTS solicitacao (
                id_soli INT(11) AUTO_INCREMENT PRIMARY KEY,
                solicitante VARCHAR(255) NOT NULL,
                responsavel VARCHAR(255) NOT NULL,
                pedido longtext,
                situacao INT(11) NOT NULL,
                criado DATE NOT NULL
            );
        ";
        $this->pdo->exec($createTableSQL);
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM solicitacao");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($solicitante, $responsavel,$pedido, $situacao, $criado) {
        $stmt = $this->pdo->prepare("
            INSERT INTO solicitacao (solicitante, responsavel, pedido,situacao, criado) 
            VALUES (:solicitante, :responsavel, :situacao, :criado)
        ");
        $stmt->execute([
            ':solicitante' => $solicitante,
            ':responsavel' => $responsavel,
            ':pedido' => $pedido,
            ':situacao' => $situacao,
            ':criado' => $criado,
        ]);
    }
}
?>

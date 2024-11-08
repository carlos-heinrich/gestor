<?php
class ControleFiscalModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function inserirDados($transacoes, $fatura, $imposto, $orcamentos) {
        $sql = "INSERT INTO controlefiscal (transacoes, fatura, imposto, orcamentos) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$transacoes, $fatura, $imposto, $orcamentos]);
    }
}
?>


<!----------------------------------------------------------------->


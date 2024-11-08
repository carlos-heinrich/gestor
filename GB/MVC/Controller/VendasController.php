<?php
require '../../Model/VendasModel.php';

class VendaController {
    private $vendaModel;

    public function __construct($pdo) {
        $this->vendaModel = new Venda($pdo);
    }

    public function criarVenda() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $produto = $_POST['produto'];
            $valor = $_POST['valor'];
            $quantidade = $_POST['quantidade'];
            $data = date('Y-m-d H:i:s');

            $this->vendaModel->criarVenda($produto, $valor, $quantidade, $data);
            echo "Venda criada com sucesso!";
        }
    }
}
?>

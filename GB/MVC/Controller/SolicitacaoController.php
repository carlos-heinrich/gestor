<?php
require '../../../MVC/Model/SolicitacaoModel.php';

class SolicitacaoController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function handleRequest() {
        $action = $_GET['action'] ?? 'index';

        switch ($action) {
            case 'create':
                $this->create();
                break;
            default:
                $this->index();
                break;
        }
    }

    private function index() {
        $solicitacaoModel = new Solicitacao($this->pdo);
        $solicitacoes = $solicitacaoModel->getAll();
        include '../../../php/solicitacao.php';
    }

    private function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $solicitante = $_POST['solicitante'];
            $responsavel = $_POST['responsavel'];
            $pedido = $_POST['pedido'];
            $situacao = $_POST['situacao'];
            $criado = date('Y-m-d');

            $solicitacaoModel = new Solicitacao($this->pdo);
            $solicitacaoModel->create($solicitante, $responsavel,$pedido, $situacao, $criado);
            header('Location: index.php');
        } else {
            include '../../../MVC/Views/SolicitacaoViews.php';
        }
    }
}
?>

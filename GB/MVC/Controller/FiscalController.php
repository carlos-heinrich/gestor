

<?php
require '../../config/config.php'; // Inclua o arquivo de configuração
require '../Model/FiscalModel.php';

class ControleFiscalController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function processarFormulario() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $transacoes = $_POST['transacoes'];
            $fatura = $_POST['fatura'];
            $imposto = $_POST['imposto'];
            $orcamentos = $_POST['orcamentos'];

            // Processa dados e calcula outros campos aqui, se necessário

            if ($this->model->inserirDados($transacoes, $fatura, $imposto, $orcamentos)) {
                echo "Dados inseridos com sucesso!";
            } else {
                echo "Erro ao inserir dados!";
            }
        }
    }
}

// Inclua as variáveis de configuração no escopo
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
$model = new ControleFiscalModel($pdo);
$controller = new ControleFiscalController($model);
$controller->processarFormulario();
header('Location: ../Views/FiscalViews.php');
?>

<!----------------------------------------------------------------->


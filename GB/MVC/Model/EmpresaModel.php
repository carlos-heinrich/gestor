    <?php
class empresaModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function criarEmpresa($nome, $servicos, $cnpj, $senha_emp, $cep, $estado, $rua, $numero)
    {

        $sql = "INSERT INTO cadastro_empresa (nome, servicos, cnpj, senha_emp, cep, estado, rua, numero) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nome, $servicos, $cnpj, $senha_emp, $cep, $estado, $rua, $numero]);

        return $stmt->rowCount();
    }


    
    public function listarEmpresas()
    {
        $sql = "SELECT * FROM cadastro_empresa";    
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }


    public function
    atualizarEmpresa(
    $id_empresa,
    $nome,
    $servicos,
    $cnpj,
    $senha_emp,
    $cep,
    $estado,
    $rua,
    $numero
    ) {
        $sql = "UPDATE cadastro_empresa  SET nome = ?, servicos = ?, cnpj = ?, senha_emp = ?, cep = ?, estado = ?, rua = ?, numero = ?)
    WHERE id_empresa = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nome, $servicos, $cnpj, $senha_emp, $cep, $estado, $rua, $numero, $id_empresa]);

    }
 
    public function deletarEmpresa($id_empresa)
    {
        $sql = "DELETE FROM cadastro_empresa  WHERE id_empresa = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_empresa]);
    }
}

?>

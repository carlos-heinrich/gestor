<?php
require_once 'C:\xampp\htdocs\gestao_bikes\GB\MVC\Model\EmpresaModel.php';

class empresaController
{
    private $empresamodel;

    public function __construct($pdo)
    {
        $this->empresamodel = new empresaModel($pdo);
    }

    public function criarEmpresa($nome, $servicos, $cnpj, $senha_emp, $cep, $estado, $rua, $numero)
    {
        $this->empresamodel->criarEmpresa($nome, $servicos, $cnpj, $senha_emp, $cep, $estado, $rua, $numero);
    }

    public function listarProdutos()
    {
        return $this->empresamodel->listarEmpresas();
    }

    public function exibirListaempresas()
    {
        $users = $this->empresamodel->listarEmpresas();
        include 'C:\xampp\htdocs\gestao_bikes\GB\MVC\Views\EmpresaViews.php';
    }

    public function atualizarEmpresa($id_empresa, $nome, $servicos, $cnpj, $senha_emp, $cep, $estado, $rua, $numero)
    {
        $this->empresamodel->atualizarEmpresa($id_empresa, $nome, $servicos, $cnpj, $senha_emp, $cep, $estado, $rua, $numero);
    }

    
    public function deletarEmpresa($id_empresa)
    {
        $this->empresamodel->deletarEmpresa($id_empresa);
    }

}

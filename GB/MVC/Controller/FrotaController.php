<?php
require_once 'C:\xampp\htdocs\gestao_bikes\GB\MVC\Model\FrotaModel.php';

class frotaController
{
    private $frotamodel;

    public function __construct($pdo)
    {
        $this->frotamodel = new frotaModel($pdo);
    }

    public function criarFrota($marca, $ano_fabricado, $modelo, $tipodeveiculo, $placaveiculo, $imagem_frota)
    {
        $this->frotamodel->criarFrota($marca, $ano_fabricado, $modelo, $tipodeveiculo, $placaveiculo, $imagem_frota);
    }

    public function listarFrotas()
    {
        return $this->frotamodel->listarFrotas();
    }

    public function exibirListafrotas()
    {
        $users = $this->frotamodel->listarFrotas();
        include 'C:\xampp\htdocs\gestao_bikes\GB\MVC\Views\FrotasViews.php';
    }

    public function atualizarFrota($id_user, $nome_completo,  $nome_usuario, $datadenascimento, $cpf, $genero, $phone, $email, $senha, $tipo_funcionario, $cep, $cidade, $rua, $numero, $complemento, $hora_entrada, $hora_saida, $carga_horaria, $remuneracao, $data_contratacao, $foto_perfil)
    {
        $this->frotamodel->atualizarFrota($id_user, $nome_completo, $nome_usuario, $datadenascimento, $cpf, $genero, $phone, $email, $senha, $tipo_funcionario, $cep, $cidade, $rua, $numero, $complemento, $hora_entrada, $hora_saida, $carga_horaria, $remuneracao, $data_contratacao, $foto_perfil);
    }

    public function deletarFrota($id_frota)
    {
        $this->frotamodel->deletarFrota($id_frota);
    }
}

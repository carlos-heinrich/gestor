<?php
class frotaModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function criarFrota($marca, $ano_fabricado, $modelo, $tipodeveiculo, $placaveiculo, $imagem_frota)
    {

        $sql = "INSERT INTO controlefrota (marca, ano_fabricado, modelo, tipodeveiculo, placaveiculo, imagem_frota) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$marca, $ano_fabricado, $modelo, $tipodeveiculo, $placaveiculo, $imagem_frota]);

        return $stmt->rowCount();
    }

    
    public function listarFrotas()
    {
        $sql = "SELECT * FROM controlefrota";    
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }


    public function
    atualizarFrota(
    $id_frota,
    $marca,
    $ano_fabricado,
    $modelo,
    $tipodeveiculo,
    $placaveiculo,
    $imagem_frota,
    ) {
        $sql = "UPDATE controlefrota SET marca = ?, ano_fabricado = ?, modelo = ?, tipodeveiculo = ?, placaveiculo = ?, imagem_frota = ?)
    WHERE id_frota = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$marca, $ano_fabricado, $modelo, $tipodeveiculo, $placaveiculo, $imagem_frota, $id_frota]);

    }
 
    public function deletarFrota($id_frota)
    {
        $sql = "DELETE FROM controlefrota WHERE id_frota = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_frota]);
    }
}

<?php

use _app\Models\Devolucao;

class DevolucaoDAO{

    public function inserir(Devolucao $devolucao){
        $sqlInserir = "INSERT INTO devolucao(emprestimo, datadevolucao) VALUES (:emprestimo, NOW())";
        $pdo = PDOFactory::getConexao();
        $comando = $pdo->prepare($sqlInserir);
        $comando->bindValue(":emprestimo", $devolucao->getEmprestimo());
        $comando->execute();
    }

    public function listar(): array
    {
        $pdo = PDOFactory::getConexao();
        $devolucao = $pdo->query('SELECT * FROM devolucao;')
                            ->fetchAll(\PDO::FETCH_ASSOC);
        return $devolucao;
    }

    public function buscarPorId($id){
        $query = 'SELECT * FROM devolucao WHERE emprestimo=:id';		
        $pdo = PDOFactory::getConexao(); 
        $comando = $pdo->prepare($query);
        $comando->bindParam ('id', $id);
        $comando->execute();
        return $comando->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function buscarEmprestimo($id)
    {
        $query = 'SELECT emprestimo FROM devolucao WHERE emprestimo=:id';
        $pdo = PDOFactory::getConexao(); 
        $comando = $pdo->prepare($query);
        $comando->bindParam('id', $id);
        $comando->execute();
        return $comando->fetch(PDO::FETCH_COLUMN);
    }
}
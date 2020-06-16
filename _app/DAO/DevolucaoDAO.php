<?php

use _app\Models\Devolucao;

class DevolucaoDAO{

    public function inserir(Devolucao $devolucao){
        // INSERT INTO livrodevolvido(livros_idlivros, clientes_idclientes, datadevolucao) VALUES (1,1, NOW())
        $sqlInserir = "INSERT INTO devolucao(emprestimo_idemprestimo, datadevolucao)
        VALUES (:emprestimo, NOW())";
        $pdo = PDOFactory::getConexao();
        $comando = $pdo->prepare($sqlInserir);
        $comando->bindValue(":emprestimo",$devolucao->emprestimo->getId());
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
        $query = 'SELECT * FROM devolucao WHERE emprestimo_idemprestimo=:id';		
        $pdo = PDOFactory::getConexao(); 
        $comando = $pdo->prepare($query);
        $comando->bindParam ('id', $id);
        $comando->execute();
        return $comando->fetchAll(\PDO::FETCH_ASSOC);
    }
}
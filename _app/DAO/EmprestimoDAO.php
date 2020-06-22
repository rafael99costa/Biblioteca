<?php

use _app\Models\Emprestimo;

class EmprestimoDAO
{
    public function inserir(Emprestimo $emprestimo)
    {

        // INSERT INTO emprestimo (livros_idlivros, clientes_idclientes,dataemprestimo, datadevolucao) VALUES (1, 1,NOW(), '1999-05-05 23:15:00');
        $sqlInserir = "INSERT INTO emprestimo(livros_idlivros, clientes_idclientes, dataemprestimo, datadevolucao) VALUES (:livro, :cliente, NOW(), NOW() + interval 14 DAY)";
        $pdo = PDOFactory::getConexao();
        $comando = $pdo->prepare($sqlInserir);
        $comando->bindValue(":livro", $emprestimo->livro->getId());
        $comando->bindValue(":cliente", $emprestimo->cliente->getId());
        $comando->execute();
    }

    public function atualizar(Emprestimo $emprestimo)
    {
        // UPDATE emprestimo SET livros_idlivros=6, clientes_idclientes=1 WHERE idlivroemprestado=60
        $sqlAtualizar = "UPDATE emprestimo SET livros_idlivros=:livros, clientes_idclientes=:cliente WHERE idemprestimos=:id";
        $pdo = PDOFactory::getConexao();
        $comando = $pdo->prepare($sqlAtualizar);
        $comando->bindValue(":id", $emprestimo->getId());
        $comando->bindValue(":livros", $emprestimo->getLivro());
        $comando->bindValue(":cliente", $emprestimo->getCliente());
        $comando->execute();
    }

    public function listar(): array
    {
        $pdo = PDOFactory::getConexao();
        $emprestimo = $pdo->query('SELECT * FROM emprestimo;')
                            ->fetchAll(\PDO::FETCH_ASSOC);

        return $emprestimo;
    }

    public function deletar($id)
    {
        $sqlDeletar = "DELETE from emprestimo WHERE idemprestimo=:id";
        $pdo = PDOFactory::getConexao();
        $comando = $pdo->prepare($sqlDeletar);
        $comando->bindValue(":id", $id);
        $comando->execute();
    }

    public function listarPorId($id)
    {
        $query = 'SELECT * FROM emprestimo WHERE idemprestimo=:id';
        $pdo = PDOFactory::getConexao(); 
        $comando = $pdo->prepare($query);
        $comando->bindParam ('id', $id);
        $comando->execute();
        $result = $comando->fetch(PDO::FETCH_OBJ);

        return new Emprestimo(
            $result->idemprestimo,
            $result->livros_idlivros,
            $result->clientes_idclientes,
            $result->dataemprestimo,
            $result->datadevolucao
        );
    }

    public function buscarPorId($id){
        $query = 'SELECT * FROM emprestimo WHERE idemprestimo=:id';		
        $pdo = PDOFactory::getConexao(); 
        $comando = $pdo->prepare($query);
        $comando->bindParam ('id', $id);
        $comando->execute();
        return $comando->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function listarPorCliente($id){
        $query = 'SELECT * FROM emprestimo WHERE clientes_idclientes=:id';		
        $pdo = PDOFactory::getConexao(); 
        $comando = $pdo->prepare($query);
        $comando->bindParam ('id', $id);
        $comando->execute();
        return $comando->fetchAll(\PDO::FETCH_ASSOC);
    }


}


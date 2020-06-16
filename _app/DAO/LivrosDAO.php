<?php

use _app\Models\Livros;

class LivrosDAO{

    public function inserir(Livros $livros){
        // INSERT INTO livros(isbn, nomelivro, editora, anopublicacao, quantidade, autor_idautores) VALUES (15, "Rafael", "dsgsg", 1544, 10, 1)
        $sqlInserir = "INSERT INTO livros(isbn, nomelivro, editora, anopublicacao, quantidade, autor_idautores) VALUES (:isbn, :nomelivro, :editora, :anopublicacao, :quantidade, :autor)";
        $pdo = PDOFactory::getConexao();
        $comando = $pdo->prepare($sqlInserir);
        $comando->bindValue(":isbn",$livros->getIsbn());
        $comando->bindValue(":nomelivro",$livros->getNomeLivro());
        $comando->bindValue(":editora",$livros->getEditora());
        $comando->bindValue(":anopublicacao",$livros->getAnoPublicacao());
        $comando->bindValue(":quantidade",$livros->getQuantidade());
        $comando->bindValue(":autor",$livros->getAutor());        
        $comando->execute();
    }

    public function atualizar(Livros $livros){
        $sqlAtualizar = "UPDATE livros SET autor_idautores=:autor, isbn=:isbn, nomelivro=:nomelivro, editora=:editora, anopublicacao=:anopublicacao, quantidade=:quantidade WHERE idlivros=:id";            
        $pdo = PDOFactory::getConexao();
        $comando = $pdo->prepare($sqlAtualizar);
        $comando->bindValue(":id",$livros->getId());
        $comando->bindValue(":autor",$livros->getAutor());
        $comando->bindValue(":isbn",$livros->getIsbn());
        $comando->bindValue(":nomelivro",$livros->getNomeLivro());
        $comando->bindValue(":editora",$livros->getEditora());
        $comando->bindValue(":anopublicacao",$livros->getAnoPublicacao());
        $comando->bindValue(":quantidade",$livros->getQuantidade());
        $comando->execute();   
    }

    public function listar(): array
    {   
        $pdo = PDOFactory::getConexao();
        $livros = $pdo->query('SELECT * FROM livros;')
                            ->fetchAll(\PDO::FETCH_ASSOC);

        return $livros;
    }


    public function deletar($id){
            $sqlDeletar = "DELETE from livros WHERE idlivros=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($sqlDeletar);
            $comando->bindValue(":id",$id);
            $comando->execute();
        }
    
    public function listarPorId($id)
    {
        $query = 'SELECT * FROM livros WHERE idlivros=:id';
        $pdo = PDOFactory::getConexao(); 
        $comando = $pdo->prepare($query);
        $comando->bindParam ('id', $id);
        $comando->execute();
        $result = $comando->fetch(PDO::FETCH_OBJ);

        return new Livros(
            $result->idlivros,
            $result->autor_idautores,
            $result->isbn,
            $result->nomelivro,
            $result->editora,
            $result->anopublicacao,
            $result->quantidade
        );                 
    }

    public function listarPorAutor($id){
        $query = 'SELECT * FROM livros WHERE autor_idautores=:id';		
        $pdo = PDOFactory::getConexao(); 
        $comando = $pdo->prepare($query);
        $comando->bindParam ('id', $id);
        $comando->execute();
        return $comando->fetchAll(\PDO::FETCH_ASSOC);

    }

    public function listarPorDisponiveis(): array
    {   
        $pdo = PDOFactory::getConexao();
        $livros = $pdo->query('SELECT * FROM livros WHERE quantidade > 0;')
                            ->fetchAll(\PDO::FETCH_ASSOC);

        return $livros;
    }

    public function listarPorNome($id){
        $query = 'SELECT * FROM livros WHERE nomelivro=:id';		
        $pdo = PDOFactory::getConexao(); 
        $comando = $pdo->prepare($query);
        $comando->bindParam ('id', $id);
        $comando->execute();
        return $comando->fetchAll(\PDO::FETCH_ASSOC);
    }
}
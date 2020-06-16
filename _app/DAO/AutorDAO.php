<?php

use _app\Models\Autor;
include_once __DIR__ . '/../Models/Autor.php';
include_once __DIR__ . '/../PDOFactory.php';


class AutorDAO{

    public function inserir(Autor $autor){
        $sqlInserir = "INSERT INTO autores(nomeautor, paisorigem) VALUES (:nomeautor, :paisorigem)";
        $pdo = PDOFactory::getConexao();
        $comando = $pdo->prepare($sqlInserir);
        // $comando->bindParam(":nomeautor",$autor->nomeautor); Você não pode passar valores ou retornos de fuções/métodos para bindParam() pois ele espera referências(variáveis) nesse caso basta trocar por bindValue().
        // $comando->bindParam(":paisorigem",$autor->paisorigem);
        $comando->bindValue(":nomeautor",$autor->getNomeAutor());
        $comando->bindValue(":paisorigem",$autor->getPaisOrigem());
        $comando->execute();
    }

    public function atualizar(Autor $autor){
        $sqlAtualizar = "UPDATE autores SET nomeautor=:nomeautor, paisorigem=:paisorigem WHERE idautores=:id";            
        $pdo = PDOFactory::getConexao();
        $comando = $pdo->prepare($sqlAtualizar);
        $comando->bindValue(":id",$autor->getId());
        $comando->bindValue(":nomeautor",$autor->getNomeAutor());
        $comando->bindValue(":paisorigem",$autor->getPaisOrigem());
        $comando->execute();   
    }

    public function listar(): array
    {   
        $pdo = PDOFactory::getConexao();
        $autores = $pdo->query('SELECT * FROM autores;')
                            ->fetchAll(\PDO::FETCH_ASSOC);

        return $autores;
    }   

    public function deletar($id){
            $sqlDeletar = "DELETE from autores WHERE idautores=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($sqlDeletar);
            $comando->bindValue(":id",$id);
            $comando->execute();
        }
       
}

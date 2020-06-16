<?php

use _app\Models\Cliente;

include_once __DIR__ . '/../Models/Cliente.php';
include_once __DIR__ . '/../PDOFactory.php';

class ClienteDAO{

    public function inserir(Cliente $cliente){
        $sqlInserir = "INSERT INTO clientes(matricula, nomecliente, telefone) VALUES (:matricula, :nomecliente, :telefone)";
        $pdo = PDOFactory::getConexao();
        $comando = $pdo->prepare($sqlInserir);
        $comando->bindValue(":matricula",$cliente->getMatricula());
        $comando->bindValue(":nomecliente",$cliente->getNomeCliente());
        $comando->bindValue(":telefone",$cliente->getTelefone());
        $comando->execute();
    }

    public function atualizar(Cliente $cliente){
        $sqlAtualizar = "UPDATE clientes SET matricula=:matricula, nomecliente=:nomecliente, telefone=:telefone WHERE idclientes=:id";            
        $pdo = PDOFactory::getConexao();
        $comando = $pdo->prepare($sqlAtualizar);
        $comando->bindValue(":id",$cliente->getId());
        $comando->bindValue(":matricula",$cliente->getMatricula());
        $comando->bindValue(":nomecliente",$cliente->getNomeCliente());
        $comando->bindValue(":telefone",$cliente->getTelefone());
        $comando->execute();   
    }

    public function listar(): array
    {   
        $pdo = PDOFactory::getConexao();
        $cliente = $pdo->query('SELECT * FROM clientes;')
                            ->fetchAll(\PDO::FETCH_ASSOC);

        return $cliente;
    }

    public function deletar($id){
        $sqlDeletar = "DELETE from clientes WHERE idclientes=:id";            
        $pdo = PDOFactory::getConexao();
        $comando = $pdo->prepare($sqlDeletar);
        $comando->bindValue(":id",$id);
        $comando->execute();
    }

    public function listarPorId($id)
    {
        $query = 'SELECT * FROM clientes WHERE idclientes=:id';
        $pdo = PDOFactory::getConexao();
        $comando = $pdo->prepare($query);
        $comando->bindParam('id', $id);
        $comando->execute();
        $result = $comando->fetch(PDO::FETCH_OBJ);

        return new Cliente(
            $result->idclientes,
            $result->matricula,
            $result->nomecliente,
            $result->telefone
        );
    } 

}
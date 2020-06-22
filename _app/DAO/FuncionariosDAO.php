<?php

use _app\Models\Funcionarios;

class FuncionariosDAO{

    public function inserir(Funcionarios $funcionarios){
        $sqlInserir = "INSERT INTO funcionarios(nome, usuario, senha) VALUES (:nome,:usuario, :senha)";
        $pdo = PDOFactory::getConexao();


        $senha = $funcionarios->getSenha();
        $senhaCrip = password_hash($senha, PASSWORD_BCRYPT);

        $comando = $pdo->prepare($sqlInserir);
        $comando->bindValue(":nome",$funcionarios->getNome());
        $comando->bindValue(":usuario",$funcionarios->getUsuario());
        $comando->bindValue(":senha",$senhaCrip);
        $comando->execute();
    }

    public function atualizar(Funcionarios $funcionarios){
        $sqlAtualizar = "UPDATE funcionarios SET nome=:nome, usuario=:usuario, senha=:senha WHERE idfuncionarios=:id";            
        $pdo = PDOFactory::getConexao();

        $senha = $funcionarios->getSenha();
        $senhaCrip = password_hash($senha, PASSWORD_BCRYPT);

        $comando = $pdo->prepare($sqlAtualizar);
        $comando->bindValue(":id",$funcionarios->getId());
        $comando->bindValue(":nome",$funcionarios->getNome());
        $comando->bindValue(":usuario",$funcionarios->getUsuario());
        $comando->bindValue(":senha",$senhaCrip);
        $comando->execute();   
    }

    public function listar(): array
    {   
        $pdo = PDOFactory::getConexao();
        $funcionarios = $pdo->query('SELECT * FROM funcionarios;')
                            ->fetchAll(\PDO::FETCH_ASSOC);

        return $funcionarios;
    }

    public function deletar($id){
            $sqlDeletar = "DELETE from funcionarios WHERE idfuncionarios=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($sqlDeletar);
            $comando->bindValue(":id",$id);
            $comando->execute();
    }

    public function buscarPorId($id)
        {
 		    $query = 'SELECT * FROM funcionarios WHERE idfuncionarios=:id';		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam ('id', $id);
		    $comando->execute();
		    $result = $comando->fetch(PDO::FETCH_OBJ);
		    return new Funcionarios($result->idfuncionarios,$result->nome,$result->usuario,$result->senha);
        }

        public function buscarPorLogin($login)
        {
 		    $query = 'SELECT * FROM funcionarios WHERE usuario=:login';		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam ('login', $login);
		    $comando->execute();
		    $result = $comando->fetch(PDO::FETCH_OBJ);
		    return new Funcionarios($result->idfuncionarios,$result->nome,$result->usuario,$result->senha);           
        }

}
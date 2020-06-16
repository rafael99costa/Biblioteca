<?php

use _app\Models\Autor;
include_once('_app/DAO/AutorDAO.php');

class AutorController{

    public function listar($request, $response, $args) {
        $dao= new AutorDAO; 
        $autor = $dao->listar();
        $autor = json_encode($autor);
        $response->getBody()->write($autor);
        return $response;
    }        
        
    
    public function inserirA($request, $response, $args){
        //Adicione nome e preço no request (formato JSON)
        $dao = new AutorDAO;
        $data = $request->getParsedBody();
        $autor = new Autor(null,$data['nomeautor'],$data['paisorigem']);
        $autor = $dao->inserir($autor);
    
        $response->getBody()->write("Cadastro do autor {$data['nomeautor']} realizado!");
        return $response;
    
        }
    
        public function atualizar($request, $response, $args) {
        $id = $args['id'];
        $data = $request->getParsedBody();
        $autor = new Autor($id, $data['nomeautor'], $data['paisorigem']);
    
        $dao = new AutorDAO;
        $autor = $dao->atualizar($autor);
    
        $response->getBody()->write("Atualização do autor {$data['nomeautor']} realizada!");
        return $response;
        }
    
        public function deletar($request, $response, $args) {
        $id = $args['id'];
    
        $dao = new AutorDAO;
        $autor = $dao->deletar($id);
    
        $response->getBody()->write('Autor Deletado!');
        return $response;
        }
}
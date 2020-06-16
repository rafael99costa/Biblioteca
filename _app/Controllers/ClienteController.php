<?php

use _app\Models\Cliente;
include_once('_app/DAO/ClienteDAO.php');

class ClienteController{

    public function listar($request, $response, $args){
        $dao= new ClienteDAO; 
        $cliente = $dao->listar();
        $cliente = json_encode($cliente);
        $response->getBody()->write($cliente);
        return $response;
    }
        
    
    public function inserir($request, $response, $args){
        //Adicione nome e preço no request (formato JSON)
        $dao = new ClienteDAO;
        $data = $request->getParsedBody();
        $cliente = new Cliente(null, $data['matricula'], $data['nomecliente'], $data['telefone']);
        $cliente = $dao->inserir($cliente);
    
        $response->getBody()->write("Cadastro de {$data['nomecliente']} realizado!");
        return $response;
    
        }
    
    
        public function atualizar($request, $response, $args){
        $id = $args['id'];
        $data = $request->getParsedBody();
        $cliente = new Cliente($id, $data['matricula'], $data['nomecliente'], $data['telefone']);
    
        $dao = new ClienteDAO;
        $cliente = $dao->atualizar($cliente);
    
        $response->getBody()->write("Atualização de {$data['nomecliente']} realizada!");
        return $response;
        }
    
        public function deletar($request, $response, $args){
        $id = $args['id'];
    
        $dao = new ClienteDAO;
        $cliente = $dao->deletar($id);
    
        $response->getBody()->write('Cliente Deletado!');
        return $response;
        }
}
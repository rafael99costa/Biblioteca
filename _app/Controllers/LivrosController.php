<?php

use _app\Models\Livros;
include_once('_app/DAO/LivrosDAO.php');



class LivrosController{

    public function listar($request, $response, $args) {
        $dao= new LivrosDAO; 
        $livro = $dao->listar();
        $livro = json_encode($livro);
        $response->getBody()->write($livro);
        return $response;
    }
        
    
    public function inserir($request, $response, $args){
        //Adicione nome e preço no request (formato JSON)
        $dao = new LivrosDAO;
        $data = $request->getParsedBody();
        $livro = new Livros(null, $data['autor_idautores'], $data['isbn'], $data['nomelivro'], $data['editora'], $data['anopublicacao'], $data['quantidade']);
        $livro = $dao->inserir($livro);
    
        $response->getBody()->write("Cadastro do livro {$data['nomelivro']} realizado!");
        return $response->withStatus(201);
    
        }
    
        public function atualizar($request, $response, $args){
        $id = $args['id'];
        $data = $request->getParsedBody();
        $livro = new Livros($id, $data['autor_idautores'], $data['isbn'], $data['nomelivro'], $data['editora'], $data['anopublicacao'], $data['quantidade']);
    
        $dao = new LivrosDAO;
        $livro = $dao->atualizar($livro);
    
        $response->getBody()->write("Atualização do livro '{$data['nomelivro']}' realizada!");
        return $response;
        }
    
        public function deletar($request, $response, $args){
        $id = $args['id'];
    
        $dao = new LivrosDAO;
        $livro = $dao->deletar($id);
    
        $response->getBody()->write('Livro Deletado');
        return $response;
        }    
        
        public function listarPorId($request, $response, $args){
            $id = $args['id'];
        
            $dao = new LivrosDAO;
            $livro = $dao->listarPorId($id);
            $livro = json_encode($livro);
            $response->getBody()->write($livro);
            return $response;
        }

        public function listarPorAutor($request, $response, $args){
            $id = $args['id'];
        
            $dao = new LivrosDAO;
            $livro = $dao->listarPorAutor($id);
            $livro = json_encode($livro);
            $response->getBody()->write($livro);
            return $response;
        }
        
        public function listarPorDisponiveis($request, $response, $args){
            $dao= new LivrosDAO; 
            $livro = $dao->listarPorDisponiveis();
            $livro = json_encode($livro);
            $response->getBody()->write($livro);    
            return $response;
        }

        public function listarPorNome($request, $response, $args){
            $id = $args['id'];
        
            $dao = new LivrosDAO;
            $livro = $dao->listarPorNome($id);
            $livro = json_encode($livro);
            if($livro == "[]"){
                $response->getBody()->write("Você não está digitando corretamente o nome do livro ou não existe!");
            }else{
                $response->getBody()->write($livro);
            }
            return $response;
        }
}
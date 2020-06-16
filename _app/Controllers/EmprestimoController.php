<?php

use _app\Models\Emprestimo;
use _app\Models\Livros;
include_once('_app/DAO/EmprestimoDAO.php');
date_default_timezone_set('America/Sao_Paulo');


class EmprestimoController{

    public function listar($request, $response, $args){
        $dao= new EmprestimoDAO; 
        $emprestimo = $dao->listar();
        $emprestimo = json_encode($emprestimo);
        $response->getBody()->write($emprestimo);
        return $response;
    }
    
    public function inserir($request, $response, $args){
        //Adicione nome e preço no request (formato JSON)
        $dao = new EmprestimoDAO;
        $daoLivros = new LivrosDAO;
        $daoCliente = new ClienteDAO;
        $data = $request->getParsedBody();

        $livros = $daoLivros->listarPorId($data["livro"]["id"]);
        $idLivros = $livros->getId();
        $autorLivro = $livros->getAutor();
        $isbn = $livros->getIsbn();
        $nomeLivro = $livros->getNomeLivro();
        $editora = $livros->getEditora();
        $anoPublicacao = $livros->getAnoPublicacao();
        $quantidade = $livros->getQuantidade();

        $clientes = $daoCliente->listarPorId($data["cliente"]["id"]);
        $idcliente = $clientes->getId();

        $emp = $dao->listarPorCliente($idcliente);
        $numeroCliente = count($emp);
        
        if($quantidade > 0 && $numeroCliente < 3){
            $emprestimo = new Emprestimo(null, $livros, $clientes, null, null);
            $emprestimo = $dao->inserir($emprestimo);    

            $livros = new Livros($idLivros,$autorLivro, $isbn, $nomeLivro, $editora, $anoPublicacao, $quantidade-1);
            $livros = $daoLivros->atualizar($livros);

            $response->getBody()->write("Cadastro realizado!");
            return $response;
        }
        elseif($quantidade <= 0){
            $response->getBody()->write("O livro não está disponível para emprestimo!");
            return $response;
        }
        elseif($numeroCliente = 3){
            $response->getBody()->write("O cliente já possui mais de 3 livro retirados!");
            return $response;
        }
        else{
            $response->getBody()->write("O cadastro não foi realizado!");
            return $response;
        }
    }
}
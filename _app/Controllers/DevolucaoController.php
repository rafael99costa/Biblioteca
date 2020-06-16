<?php

use _app\Models\Devolucao;
use _app\Models\Livros;

include_once('_app/DAO/DevolucaoDAO.php');
date_default_timezone_set('America/Sao_Paulo');

class DevolucaoController{

    public function listar($request, $response, $args) {
        $dao= new DevolucaoDAO; 
        $devolucao = $dao->listar();
        $devolucao = json_encode($devolucao);
        $response->getBody()->write($devolucao);
        return $response;
    }
        
    public function inserir($request, $response, $args){
        //Adicione nome e preço no request (formato JSON)
        $dao = new DevolucaoDAO;
        $daoEmprestimo = new EmprestimoDAO;
        $daoLivros = new LivrosDAO;
        $daoCliente = new ClienteDAO;
        $data = $request->getParsedBody();

        $emp = $data["emprestimo"]["id"];

        $emprestimos = $daoEmprestimo->listarPorId($emp);
        $idEmprestimo = $emprestimos->getId();
        $livroEmprestimo = $emprestimos->getLivro();
        $clienteEmprestimo = $emprestimos->getCliente();
        $dataEmprestimo = $emprestimos->getDataEmprestimo();
        $dataDevolucao = $emprestimos->getDataDevolucao();

        $hoje = date("d");
        $dataDevolucao = date('d', strtotime($dataDevolucao));
        $multa = $hoje - $dataDevolucao;

        $livros = $daoLivros->listarPorId($livroEmprestimo);
        $idLivros = $livros->getId();
        $autorLivro = $livros->getAutor();
        $isbn = $livros->getIsbn();
        $nomeLivro = $livros->getNomeLivro();
        $editora = $livros->getEditora();
        $anoPublicacao = $livros->getAnoPublicacao();
        $quantidade = $livros->getQuantidade();

        $cliente = $daoCliente->listarPorId($clienteEmprestimo);
        $nomeCliente = $cliente->getNomeCliente();

        $devol = $dao->buscarPorId($emp);
        $num = count($devol);

        if($num == 0){
            $devolucao = new Devolucao(null, $emprestimos);
            $devolucao = $dao->inserir($devolucao);

            $livro = new Livros($idLivros,$autorLivro, $isbn, $nomeLivro, $editora, $anoPublicacao, $quantidade+1);
            $livro = $daoLivros->atualizar($livro);

            if($multa > 0){
                $response->getBody()->write("Dias de multa: {$multa} \n Devolução Efetuada");
                return $response;
            }else{
                $response->getBody()->write("Entrega no prazo \n Devolução Efetuada");
                return $response;
            }
        }else{
            $response->getBody()->write("O livro {$nomeLivro} já foi devolvido pelo cliente {$nomeCliente}");
            return $response;
        }

        
    }
}
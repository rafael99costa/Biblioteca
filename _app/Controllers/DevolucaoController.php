<?php

use _app\Models\Devolucao;
use _app\Models\Emprestimo;
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

        $emp = $data['emprestimo'];
        $buscarEmprestimo = $dao->buscarEmprestimo($emp);
        $busEmp[] = $buscarEmprestimo;
        
        // $devol = $dao->buscarPorId($emp);
        // $num = count($devol);
        $a = $daoEmprestimo->buscarPorId($emp);
        $ab = count($a);

        $devol = $dao->buscarPorId($emp);
        $num = count($devol);

        if(in_array($emp, $busEmp)){
            $response->getBody()->write("O livro já foi devolvido pelo cliente");
            return $response;
        }
        elseif($ab == 0){
            $response->getBody()->write("Não existe o codigo de emprestimo");
            return $response;
        }
        
        $emprestimos = $daoEmprestimo->listarPorId($emp);
        $idEmprestimo = $emprestimos->getId();
        $livroEmprestimo = $emprestimos->getLivro();
        $clienteEmprestimo = $emprestimos->getCliente();
        $dataEmprestimo = $emprestimos->getDataEmprestimo();
        $dataDevolucao = $emprestimos->getDataDevolucao();

        $hoje = strtotime(date("Y-m-d H:i:s"));  
        $diaDevolucao = strtotime($dataDevolucao);
        $diferenca = $hoje - $diaDevolucao;
        $multa = (int)floor( $diferenca / (60 * 60 * 24));

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
            $devolucao = new Devolucao(null, $emp, null);
            $devolucao = $dao->inserir($devolucao);

            $livro = new Livros($idLivros,$autorLivro, $isbn, $nomeLivro, $editora, $anoPublicacao, $quantidade+1);
            $livro = $daoLivros->atualizar($livro);

            $deleteEmprestimo = $daoEmprestimo->deletar($idEmprestimo);

            if($multa > 0){
                $response->getBody()->write("Dias de multa: {$multa} \n Devolução Efetuada");
                return $response;
            }else{
                $response->getBody()->write("Entrega no prazo \n Devolução Efetuada");
                return $response;
            }
        }
    }
}
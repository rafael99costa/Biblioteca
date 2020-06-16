<?php

namespace _app\Models;


class Emprestimo{

    public $id;
    public $dataemprestimo;
    public $datadevolucao;
    public $livro;
    public $cliente;

    public function __construct($id, $livro, $cliente, $dataemprestimo, $datadevolucao)
    {      
        $this->id = $id;   
        $this->livro = $livro;
        $this->cliente = $cliente;
        $this->dataemprestimo = $dataemprestimo;   
        $this->datadevolucao = $datadevolucao;   
    }

    public function setId($id) {
        $this->id = $id;
    }
    
    public function getId(){
        return $this->id;
    }

    public function setDataEmprestimo($dataemprestimo) {
        $this->dataemprestimo = $dataemprestimo;
    }
    
    public function getDataEmprestimo(){
        return $this->dataemprestimo;
    }

    public function setDataDevolucao($datadevolucao) {
        $this->datadevolucao = $datadevolucao;
    }
    
    public function getDataDevolucao(){
        return $this->datadevolucao;
    }

    public function setLivro($livro) {
        $this->livro = $livro;
    }
    
    public function getLivro(){
        return $this->livro;
    }

    public function setCliente($cliente) {
        $this->cliente = $cliente;
    }
    
    public function getCliente(){
        return $this->cliente;
    }
}   
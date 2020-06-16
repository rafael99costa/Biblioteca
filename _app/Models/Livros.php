<?php

namespace _app\Models;

class Livros{

    public $id;
    public $isbn;
    public $nomelivro;
    public $editora;
    public $anopublicacao;
    public $quantidade;
    public $autor;

    

    public function __construct($id, $autor, $isbn, $nomelivro, $editora, $anopublicacao, $quantidade) // Autor $autor -- o metodo ($autor) só ira aceitar um objeto da classe (Autor)
    {   
        $this->id = $id;
        $this->autor = $autor;
        $this->isbn = $isbn;
        $this->nomelivro = $nomelivro;
        $this->editora = $editora;
        $this->anopublicacao = $anopublicacao;
        $this->quantidade = $quantidade;
    }

    public function setId($id) {
        $this->id = $id;
    }
    
    public function getId(){
        return $this->id;
    }

    public function setIsbn($isbn) {
        $this->id = $isbn;
    }
    
    public function getIsbn(){
        return $this->isbn;
    }

    public function setNomeLivro($nomelivro) {
        $this->nomelivro = $nomelivro;
    }
    
    public function getNomeLivro(){
        return $this->nomelivro;
    }

    public function getEditora(){
        return $this->editora;
    }

    public function setEditora($editora) {
        $this->editora = $editora;
    }
    
    public function getAnoPublicacao(){
        return $this->anopublicacao;
    }

    public function setAnoPublicacao($anopublicacao) {
        $this->anopublicacao = $anopublicacao;
    }
    
   
    public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }
    
    public function getQuantidade(){
        return $this->quantidade;
    }

    public function setAutor($autor) {
        $this->autor = $autor;
    }
    
    public function getAutor(){
        return $this->autor;
    }


}

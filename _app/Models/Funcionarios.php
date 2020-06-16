<?php

namespace _app\Models;

class Funcionarios{

    public $id;
    public $nome;
    public $usuario;
    public $senha;

    public function __construct($id, $nome, $usuario, $senha)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->usuario = $usuario;
        $this->senha = $senha;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function getId(){
        return $this->id;
    }
    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    public function getNome(){
        return $this->nome;
    }

    public function getUsuario(){
        return $this->usuario;
    }

    public function setUsuario($usuario) {
        $this->id = $usuario;
    }

    public function getSenha(){
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->id = $senha;
    }

    

}
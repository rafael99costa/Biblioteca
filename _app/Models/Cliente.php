<?php

namespace _app\Models;

class Cliente{

    private $id;
    private $matricula;
    private $nomecliente;
    private $telefone;


    public function __construct($id, $matricula, $nomecliente, $telefone)
    {
        $this->id = $id; // o $id é do construct
        $this->matricula = $matricula; 
        $this->nomecliente = $nomecliente; 
        $this->telefone = $telefone; 
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setMatricula($matricula){
        $this->matricula = $matricula;
    }

    public function getMatricula(){
        return $this->matricula;
    }

    public function setNomeCliente($nomecliente){
        $this->nomecliente = $nomecliente;
    }

    public function getNomeCliente(){
        return $this->nomecliente;
    }
    
    public function setTelefone($telefone){
        $this->paisortelefoneigem = $telefone;
    }

    public function getTelefone(){
        return $this->telefone;
    }


}
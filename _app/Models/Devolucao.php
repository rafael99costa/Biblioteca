<?php

namespace _app\Models;


class Devolucao{

    public $id;
    public $datadevolucao;
    public $emprestimo;

    public function __construct($id, $emprestimo, $datadevolucao)
    {      
        $this->id = $id;   
        $this->emprestimo = $emprestimo;  
        $this->datadevolucao = $datadevolucao;  
    }

    public function setId($id) {
        $this->id = $id;
    }
    
    public function getId(){
        return $this->id;
    }

    public function setDataDevolucao($datadevolucao) {
        $this->datadevolucao = $datadevolucao;
    }
    
    public function getDataDevolucao(){
        return $this->datadevolucao;
    }

    public function setEmprestimo($emprestimo) {
        $this->emprestimo = $emprestimo;
    }
    
    public function getEmprestimo(){
        return $this->emprestimo;
    }


}   
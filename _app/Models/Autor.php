<?php

namespace _app\Models;

class Autor{

    private $id;
    private $nomeautor;
    private $paisorigem;

    public function __construct($id, $nomeautor, $paisorigem)
    {
        $this->id = $id;
        $this->nomeautor = $nomeautor;
        $this->paisorigem = $paisorigem;
    }

    
    public function setId($id) {
        $this->id = $id;
    }
    public function setNomeAutor($nomeautor) {
        $this->nomeautor = $nomeautor;
    }
    public function setPaisOrigem($paisorigem) {
        $this->paisorigem = $paisorigem;
    }

    public function getId(){
        return $this->id;
    }
    public function getNomeAutor(){
        return $this->nomeautor;
    }
    public function getPaisOrigem(){
        return $this->paisorigem;
    }
    
}

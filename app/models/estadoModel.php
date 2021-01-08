<?php

class EstadoModel
{
    public
        $sigla,
        $nome;

    public function __construct($s, $n)
    {
        $this->sigla = $s;
        $this->nome = $n;
    }
}
<?php
class PacienteAutoModel
{
    public $id,
        $datanascimento,
        $nome;

    public function __construct($i, $n, $d)
    {
        $this->id = $i;
        $this->datanascimento = $d;
        $this->nome = $n;
    }
}

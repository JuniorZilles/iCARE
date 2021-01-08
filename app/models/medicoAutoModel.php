<?php
class MedicoAutoModel
{
    public $id,
        $nome,
        $telefone,
        $especialidade,
        $crm;

    public function __construct($i, $n, $e, $c, $t)
    {
        $this->id = $i;
        $this->nome = $n;
        $this->telefone = $t;
        $this->especialidade = $e;
        $this->crm = $c;
    }
}
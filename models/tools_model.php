<?php
class Paciente
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

class Medico
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

class Estado
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

class Autocomplete
{
    public
        $exames,
        $estados,
        $especialidades;

    public function __construct($s, $n, $e)
    {
        $this->exames = $s;
        $this->estados = $n;
        $this->especialidades = $e;
    }
}

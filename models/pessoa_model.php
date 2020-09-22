<?php
class Pessoa
{
    public $_id,
        $tipo,
        $nome,
        $telefone,
        $rua,
        $numero,
        $bairro,
        $complemento,
        $cidade,
        $estado,
        $cep,
        $email,
        $senha;

    public function __construct($i, $t, $n, $te, $r, $nu, $b, $c, $ci, $e, $ce, $em, $s)
    {
        $this->_id = $i;
        $this->tipo = $t;
        $this->nome = $n;
        $this->telefone = $te;
        $this->rua = $r;
        $this->numero = $nu;
        $this->bairro = $b;
        $this->complemento = $c;
        $this->cidade = $ci;
        $this->estado = $e;
        $this->cep = $ce;
        $this->email = $em;
        $this->senha = $s;
    }
}

class Paciente extends Pessoa
{
    public
        $genero,
        $datanascimento,
        $cpf;
    public function __construct($i, $t, $n, $te, $r, $nu, $b, $c, $ci, $e, $ce, $em, $s, $g, $d, $cp)
    {
        parent::__construct($i, $t, $n, $te, $r, $nu, $b, $c, $ci, $e, $ce, $em, $s);
        $this->genero = $g;
        $this->datanascimento = $d;
        $this->cpf = $cp;
    }
}

class Medico extends Pessoa
{
    public $especialidade, $crm;

    public function __construct($i, $t, $n, $te, $r, $nu, $b, $c, $ci, $e, $ce, $em, $s, $es, $cr)
    {
        parent::__construct($i, $t, $n, $te, $r, $nu, $b, $c, $ci, $e, $ce, $em, $s);
        $this->especialidade = $es;
        $this->crm = $cr;
    }
}

class Laboratorio extends Pessoa
{
    public $tipoexame, $cnpj;

    public function __construct($i, $t, $n, $te, $r, $nu, $b, $c, $ci, $e, $ce, $em, $s, $ti, $cn)
    {
        parent::__construct($i, $t, $n, $te, $r, $nu, $b, $c, $ci, $e, $ce, $em, $s);
        $this->tipoexame = $ti;
        $this->cnpj = $cn;
    }
}

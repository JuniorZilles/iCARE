<?php
class PessoaModel
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



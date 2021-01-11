<?php
class MedicoModel extends PessoaModel
{
    public $especialidade, $crm;

    public function __construct($i, $t, $n, $te, $r, $nu, $b, $c, $ci, $e, $ce, $em, $s, $es, $cr)
    {
        parent::__construct($i, $t, $n, $te, $r, $nu, $b, $c, $ci, $e, $ce, $em, $s);
        $this->especialidade = $es;
        $this->crm = $cr;
    }
}
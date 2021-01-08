<?php 
class LaboratorioModel extends PessoaModel
{
    public $tipoexame, $cnpj;

    public function __construct($i, $t, $n, $te, $r, $nu, $b, $c, $ci, $e, $ce, $em, $s, $ti, $cn)
    {
        parent::__construct($i, $t, $n, $te, $r, $nu, $b, $c, $ci, $e, $ce, $em, $s);
        $this->tipoexame = $ti;
        $this->cnpj = $cn;
    }
}

<?php
class PacienteModel extends PessoaModel
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
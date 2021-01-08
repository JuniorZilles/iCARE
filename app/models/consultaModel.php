<?php

class ConsultaModel extends BaseCadastroModel
{
    public $sintomas, $receita;
    public function __construct($i, $h, $d, $p, $o, $ou, $m, $s, $r)
    {
        parent::__construct($i, $h, $d, $p, $o, $ou, $m);
        $this->sintomas = $s;
        $this->receita = $r;
    }
}
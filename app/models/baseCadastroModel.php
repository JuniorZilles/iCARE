<?php

class BaseCadastroModel
{
    public $_id,
        $hora,
        $data,
        $observacao,
        $pacienteid,
        $medicoid,
        $outro;

    public function __construct($i, $h, $d, $p, $o, $ou, $m)
    {
        $this->_id = $i;
        $this->hora = $h;
        $this->data = $d;
        $this->pacienteid = $p;
        $this->observacao = $o;
        $this->medicoid = $m;
        $this->outro = $ou;
    }
}


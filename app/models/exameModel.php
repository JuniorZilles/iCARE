<?php
class ExameModel extends BaseCadastroModel
{
    public $tipoexame, $resultado, $laboratorioid;

    public function __construct($i, $h, $d, $p, $o, $ou, $m, $e, $r, $l)
    {
        parent::__construct($i, $h, $d, $p, $o, $ou, $m);
        $this->tipoexame = $e;
        $this->resultado = $r;
        $this->laboratorioid = $l;
    }
}

<?php 
    class Cadastro{
        public $id,
        $hora,
        $data,
        $observacao,
        $pacienteid,
        $medicoid,
        $outro;

        public function __construct($i, $h, $d, $p, $o, $ou, $m)
        {
            $this->id = $i;
            $this->hora = $h;
            $this->data = $d;
            $this->pacienteid = $p;
            $this->observacao = $o;
            $this->medicoid = $m;
            $this->outro = $ou;
        }
    }

    class Consulta extends Cadastro{
        public $sintomas;

        public function __construct($i, $h, $d, $p, $o, $ou, $m, $s)
        {
            parent::__construct($i, $h, $d, $p, $o,$ou, $m);
            $this->sintomas = $s;
        }
    }

    class Exame extends Cadastro{
        public $tipoexame, $resultado, $laboratorioid;

        public function __construct($i, $h, $d, $p, $o, $ou, $m, $e, $r, $l)
        {
            parent::__construct($i, $h, $d, $p, $o, $ou, $m);
            $this->tipoexame = $e;
            $this->resultado = $r;
            $this->laboratorioid = $l;
        }
    }
?>
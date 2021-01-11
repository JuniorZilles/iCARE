<?php

class EstatisticaModel
{
    private $db;

    public function __construct()
    {
        $this->db = Conexao::getConexao();
    }

    public function getStatistics($id, $tipo)
    {
        $_exame = $_consulta = null;
        $_exame_array = $_consulta_array = $_user_array = array();

        if ($tipo == 'medico') {
            $coll = $this->db->consultas;
            $selec = array("_id", "medicoid", "data");
            $query = array("medicoid" => $id);
            $_consulta = $coll->find($query, $selec);
        } elseif ($tipo == 'laboratorio') {
            $coll = $this->db->exames;
            $selec = array("_id", "laboratorioid", "data");
            $query = array("laboratorioid" => $id);
            $_exame = $coll->find($query, $selec);
        } elseif ($tipo == 'paciente') {
            $coll = $this->db->exames;
            $selec = array("_id", "laboratorioid", "data");
            $query = array("pacienteid" => $id);
            $_exame = $coll->find($query, $selec);
            $coll = $this->db->consultas;
            $selec = array("_id", "medicoid", "data");
            $query = array("pacienteid" => $id);
            $_consulta = $coll->find($query, $selec);
        } elseif ($tipo == 'admin') {
            $coll = $this->db->exames;
            $selec = array("_id", "laboratorioid", "data");
            $_exame = $coll->find(array(), $selec);
            $coll = $this->db->consultas;
            $selec = array("_id", "medicoid", "data");
            $_consulta = $coll->find(array(), $selec);
            $coll = $this->db->users;
            $_pac_cont = $coll->find(array('tipo' => 'paciente'))->count();
            $_lab_cont = $coll->find(array('tipo' => 'laboratorio'))->count();
            $_med_cont = $coll->find(array('tipo' => 'medico'))->count();
            array_push($_user_array, array('tipo' => 'Paciente', 'qtd' => $_pac_cont));
            array_push($_user_array, array('tipo' => 'Laboratório', 'qtd' => $_lab_cont));
            array_push($_user_array, array('tipo' => 'Médico', 'qtd' => $_med_cont));
        }
        if(isset($_consulta))
            $_consulta->sort(array('data' => -1));
        if(isset($_exame))
            $_exame->sort(array('data' => -1));
        
        $_consulta_array = $this->getArrayReg($_consulta, 0);
        $_exame_array = $this->getArrayReg($_exame, 1);
        return ['users' => $_user_array, 'consultas_exames' => array_merge($_consulta_array, $_exame_array)];
    }

    public function getArrayReg($list, $tipo)
    {
        $_array = array();
        if (count($list) > 0) {
            foreach ($list as $item) {
                $_userid = '';
                $_tipo = '';
                if ($tipo == 1) {
                    $_userid = (string)$item['laboratorioid'];
                    $_tipo = 'Exame';
                }
                if ($tipo == 0) {
                    $_userid = (string)$item['medicoid'];
                    $_tipo = 'Consulta';
                }
                $_mes = substr((string)$item['data'], 0, 7);
                $coll = $this->db->users;
                $selec = array("nome");
                $query = array("_id" => $_userid);
                $r = $coll->findOne($query, $selec);
                $_nome = $r['nome'];

                $key1 = array_search($_nome, array_column($_array, 'nome'));
                if ($key1 !== false) {
                    $key2 = array_search($_mes, array_column($_array[$key1]['reg'], 'mes'));
                    if ($key2 !== false)
                        $_array[$key1]['reg'][$key2]['qtd'] += 1;
                    else
                        array_push($_array[$key1]['reg'], array('mes' => $_mes, 'qtd' => 1));
                } else
                    array_push($_array, array('nome' => $_nome, 'tipo' => $_tipo, 'reg' => [array('mes' => $_mes, 'qtd' => 1)]));
            }
        }
        return $_array;
    }
}

<?php
require_once '../database/db_instance.php';

function get_data($_id, $_tipo)
{
    $db = connectDB();
    $_exame = $_consulta = null;
    $_exame_array = $_consulta_array = $_user_array = array();

    if ($_tipo == 'medico') {
        $coll = $db->consultas;
        $selec = array("_id", "medicoid", "data");
        $query = array("medicoid" => $_id);
        $_consulta = $coll->find($query, $selec);
    } elseif ($_tipo == 'laboratorio') {
        $coll = $db->exames;
        $selec = array("_id", "laboratorioid", "data");
        $query = array("laboratorioid" => $_id);
        $_exame = $coll->find($query, $selec);
    } elseif ($_tipo == 'paciente') {
        $coll = $db->exames;
        $selec = array("_id", "laboratorioid", "data");
        $query = array("pacienteid" => $_id);
        $_exame = $coll->find($query, $selec);
        $coll = $db->consultas;
        $selec = array("_id", "medicoid", "data");
        $query = array("pacienteid" => $_id);
        $_consulta = $coll->find($query, $selec);
    } elseif ($_tipo == 'admin') {
        $coll = $db->exames;
        $selec = array("_id", "laboratorioid", "data");
        $_exame = $coll->find(array(), $selec);
        $coll = $db->consultas;
        $selec = array("_id", "medicoid", "data");
        $_consulta = $coll->find(array(), $selec);
        $coll = $db->users;
        $_pac_cont = $coll->find(array('tipo' => 'paciente'))->count();
        $_lab_cont = $coll->find(array('tipo' => 'laboratorio'))->count();
        $_med_cont = $coll->find(array('tipo' => 'medico'))->count();
        array_push($_user_array, array('tipo' => 'Paciente', 'qtd' => $_pac_cont));
        array_push($_user_array, array('tipo' => 'Laboratório', 'qtd' => $_lab_cont));
        array_push($_user_array, array('tipo' => 'Médico', 'qtd' => $_med_cont));
    }
    $_consulta_array = getArrayReg($_consulta, $db, 0);
    $_exame_array = getArrayReg($_exame, $db, 1);
    return ['users' => $_user_array, 'consultas_exames' => array_merge($_consulta_array, $_exame_array)];
}

function getArrayReg($list, $db, $tipo)
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
            $coll = $db->users;
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

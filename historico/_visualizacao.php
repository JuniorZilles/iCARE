<?php
session_start();

require_once '../tools/utilities.php';
require_once '../models/cadastro_model.php';
require_once '../database/db_instance.php';

try {
    $_pacienteid = $_id = $_tipo = $_opcao = "";
    $_exame_consulta = $_regitro = null;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['pacienteid'])) {
            if (!empty($_POST["pacienteid"])) {
                $_id = remove_inseguro($_POST["pacienteid"]);
            }
        }
        if (isset($_POST['tipo'])) {
            if (!empty($_POST["tipo"])) {
                $_opcao = remove_inseguro($_POST["tipo"]);
            }
        }
        $_objeto = getData($_opcao, $_id, $_SESSION['tipo']);
        if ($_opcao == 'consulta') {
            $_SESSION['registro'] = serialize($_objeto);
            header("Location: historico_consulta.php");
        } else {
            $_SESSION['registro'] = serialize($_objeto);
            header("Location: historico_exame.php");
        }
    } else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $_tipo = $_SESSION['tipo'];
        if (isset($_GET['opcao'])) {
            $_opcao = remove_inseguro($_GET['opcao']);
        }

        if ($_tipo != 'admin') $_id = $_SESSION['user'];

        $_objeto = getData($_opcao, $_id, $_tipo);
        if ($_opcao == 'consulta') {
            $_SESSION['registro'] = serialize($_objeto);
            header("Location: historico_consulta.php");
        } else {
            $_SESSION['registro'] = serialize($_objeto);
            header("Location: historico_exame.php");
        }
    }
} catch (Throwable $e) {
    $_SESSION['erro'] = makeerrortoast($e->getMessage() . PHP_EOL);
    header("Location: ../home/index.php");
} catch (Exception $e) {
    $_SESSION['erro'] = makeerrortoast($e->getMessage() . PHP_EOL);
    header("Location: ../home/index.php");
}


function getData($_opcao, $_id, $_tipo)
{
    $_objeto = array();
    $db = connectDB();

    if ($_opcao == 'consulta' && !empty($_id) && ($_tipo == 'medico' || $_tipo == 'admin')) {
        $coll = $db->consultas;
        $query = array("medicoid" => $_id);
        $_exame_consulta = $coll->find($query);
    } elseif ($_opcao == 'consulta' && !empty($_id) && ($_tipo == 'paciente' || $_tipo == 'admin')) {
        $coll = $db->consultas;
        $query = array("pacienteid" => $_id);
        $_exame_consulta = $coll->find($query);
    } elseif ($_opcao == 'exame' && !empty($_id) && ($_tipo == 'laboratorio' || $_tipo == 'admin')) {
        $coll = $db->exames;
        $query = array("laboratorioid" => $_id);
        $_exame_consulta = $coll->find($query);
    } elseif ($_opcao == 'exame' && !empty($_id) && ($_tipo == 'paciente' || $_tipo == 'admin')) {
        $coll = $db->exames;
        $query = array("pacienteid" => $_id);
        $_exame_consulta = $coll->find($query);
    } elseif ($_opcao == 'consulta' && $_tipo == 'admin') {
        $coll = $db->consultas;
        $_exame_consulta = $coll->find();
    } elseif ($_opcao == 'exame' && $_tipo == 'admin') {
        $coll = $db->exames;
        $_exame_consulta = $coll->find();
    }
    foreach ($_exame_consulta as $item) {
        $_regitro = new Registro();
        if (isset($item['laboratorioid'])) {
            $_labid = (string)$item['laboratorioid'];
            $coll = $db->users;
            $query = array("_id" => $_labid);
            $lab = $coll->findOne($query);
            $_regitro->laboratorio = obter_usuario_visualizacao($lab);
            $_regitro->consulta_exame = obter_visualizacao_exame($item);
        } else {
            $_regitro->consulta_exame = obter_visualizacao_consulta($item);
        }
        $_pacid = (string)$item['pacienteid'];
        $coll = $db->users;
        $query = array("_id" => $_pacid);
        $pac = $coll->findOne($query);
        $_regitro->paciente = obter_usuario_visualizacao($pac);
        $_medicid = (string)$item['medicoid'];
        $coll = $db->users;
        $query = array("_id" => $_medicid);
        $medic = $coll->findOne($query);
        $_regitro->medico = obter_usuario_visualizacao($medic);
        array_push($_objeto, $_regitro);
        $_regitro = null;
    }
    return $_objeto;
}

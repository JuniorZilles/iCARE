<?php
session_start();

require_once '../tools/utilities.php';
require_once '../models/cadastro_model.php';
try {
    $_pacienteid = $_id = $_tipo = $_opcao = "";
    $_exame_consulta = $_paciente = $_medico = $_laboratorio = $_regitro = null;
    $_objeto = array();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $xml = simplexml_load_file('dados.xml');
        if (isset($_POST['pacienteid'])) {
            if (!empty($_POST["pacienteid"])) {
                $_pacienteid = remove_inseguro($_POST["pacienteid"]);
            }
        }
        if (isset($_POST['tipo'])) {
            if (!empty($_POST["tipo"])) {
                $_tipo = remove_inseguro($_POST["tipo"]);
            }
        }
        if ($_tipo == 'consulta' && !empty($_pacienteid) && $_SESSION['tipo'] == 'admin')
            $_exame_consulta = $xml->xpath("//consulta[pacienteid = '$_pacienteid']");
        elseif ($_tipo == 'consulta' && $_SESSION['tipo'] == 'admin')
            $_exame_consulta = $xml->xpath("//consulta");
        elseif ($_tipo == 'exame' && !empty($_pacienteid) && $_SESSION['tipo'] == 'admin')
            $_exame_consulta = $xml->xpath("//exame[pacienteid = '$_pacienteid']");
        elseif ($_tipo == 'exame' && $_SESSION['tipo'] == 'admin')
            $_exame_consulta = $xml->xpath("//exame");
        for ($i = 0; $i < count($_exame_consulta); $i++) {
            $_regitro = new Registro();
            if (isset($_exame_consulta[$i]->laboratorioid)) {
                $_labid = (string)$_exame_consulta[$i]->laboratorioid;
                $lab = $xml->xpath("//user[id = '$_labid']");
                $_regitro->laboratorio = obter_usuario_visualizacao($lab[0]);
                $_regitro->consulta_exame = obter_visualizacao_exame($_exame_consulta[$i]);
            } else {
                $_regitro->consulta_exame = obter_visualizacao_consulta($_exame_consulta[$i]);
            }
            $_pacid = (string)$_exame_consulta[$i]->pacienteid;
            $pac = $xml->xpath("//user[id = '$_pacid']");
            $_regitro->paciente = obter_usuario_visualizacao($pac[0]);
            $_medicid = (string)$_exame_consulta[$i]->medicoid;
            $medic = $xml->xpath("//user[id = '$_medicid']");
            $_regitro->medico = obter_usuario_visualizacao($medic[0]);
            if ($_tipo == 'consulta')
                $_regitro->consulta_exame = obter_visualizacao_exame($_exame_consulta[$i]);
            array_push($_objeto, $_regitro);
            $_regitro = null;
        }
        if ($_tipo == 'consulta') {
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
        $_id = $_SESSION['user'];
        $xml = simplexml_load_file('dados.xml');

        if ($_opcao == 'consulta' && $_tipo == 'medico')
            $_exame_consulta = $xml->xpath("//consulta[medicoid = '$_id']");
        elseif ($_opcao == 'exame' && $_tipo == 'laboratorio')
            $_exame_consulta = $xml->xpath("//exame[laboratorioid = '$_id']");
        elseif ($_opcao == 'exame' && $_tipo == 'paciente')
            $_exame_consulta = $xml->xpath("//exame[pacienteid = '$_id']");
        elseif ($_opcao == 'consulta' && $_tipo == 'paciente')
            $_exame_consulta = $xml->xpath("//consulta[pacienteid = '$_id']");
        elseif ($_opcao == 'exame' && $_tipo == 'admin')
            $_exame_consulta = $xml->xpath("//exame");
        elseif ($_opcao == 'consulta' && $_tipo == 'admin')
            $_exame_consulta = $xml->xpath("//consulta");
        for ($i = 0; $i < count($_exame_consulta); $i++) {
            $_regitro = new Registro();
            if (isset($_exame_consulta[$i]->laboratorioid)) {
                $_labid = (string)$_exame_consulta[$i]->laboratorioid;
                $lab = $xml->xpath("//user[id = '$_labid']");
                $_regitro->laboratorio = obter_usuario_visualizacao($lab[0]);
                $_regitro->consulta_exame = obter_visualizacao_exame($_exame_consulta[$i]);
            } else {
                $_regitro->consulta_exame = obter_visualizacao_consulta($_exame_consulta[$i]);
            }
            $_pacid = (string)$_exame_consulta[$i]->pacienteid;
            $pac = $xml->xpath("//user[id = '$_pacid']");
            $_regitro->paciente = obter_usuario_visualizacao($pac[0]);
            $_medicid = (string)$_exame_consulta[$i]->medicoid;
            $medic = $xml->xpath("//user[id = '$_medicid']");
            $_regitro->medico = obter_usuario_visualizacao($medic[0]);
            if ($_opcao == 'exame')
                $_regitro->consulta_exame = obter_visualizacao_exame($_exame_consulta[$i]);
            array_push($_objeto, $_regitro);
            $_regitro = null;
        }
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

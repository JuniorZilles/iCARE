<?php
session_start();

require_once '../tools/utilities.php';
require_once '../models/cadastro_model.php';
require_once '../database/db_instance.php';

try {

    $_id = $_idpaciente =
        $_idmedico = $_exames = $_tipoexame =
        $_outroexame =
        $_dataexame =
        $_horarioexame =
        $_resultadoexame =
        $_resultado =
        $_erro = '';
    $_objeto = null;
    $_edicao = false;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_id = md5(uniqid(""));
        if (isset($_POST['identificadorexame'])) {
            if (!empty($_POST["identificadorexame"])) {
                $_id = remove_inseguro($_POST["identificadorexame"]);
                $_edicao = true;
            }
        }
        if (isset($_POST['pacienteid'])) {
            if (empty($_POST["pacienteid"])) {
                $_erro .= 'Paciente não selecionado!<br>';
            } else {
                $_idpaciente = remove_inseguro($_POST["pacienteid"]);
            }
        }
        if (isset($_POST['medicoid'])) {
            if (empty($_POST["medicoid"])) {
                $_erro .= 'Médico não informado!<br>';
            } else {
                $_idmedico = remove_inseguro($_POST["medicoid"]);
            }
        }
        if (isset($_POST['exame'])) {
            if (empty($_POST["exame"])) {
                $_erro .= 'Nenhum exame foi selecionado!<br>';
            } else {
                $secured = remove_inseguro($_POST["exame"]);
                $_exames = explode(",", $secured);
            }
        }
        if (isset($_POST['dataexame'])) {
            if (empty($_POST["dataexame"])) {
                $_erro .= 'Data não informada!<br>';
            } else {
                $_dataexame = remove_inseguro($_POST["dataexame"]);
            }
        }
        if (isset($_POST['horarioexame'])) {
            if (empty($_POST["horarioexame"])) {
                $_erro .= 'Horário não informado!<br>';
            } else {
                $_horarioexame = remove_inseguro($_POST["horarioexame"]);
            }
        }
        if (isset($_POST['resultadoexame'])) {
            if (empty($_POST["resultadoexame"])) {
                $_erro .= 'Resultado do exame não informado!<br>';
            } else {
                $_resultadoexame = remove_inseguro($_POST["resultadoexame"]);
            }
        }
        if (isset($_POST['resultado'])) {
            if (empty($_POST["resultado"])) {
                $_erro .= 'Descrição dos resulados não informado!<br>';
            } else {
                $_resultado = remove_inseguro($_POST["resultado"]);
            }
        }
        if (isset($_POST['outro'])) {
            $_outroexame = remove_inseguro($_POST["outro"]);
        }
        $_objeto = new Exame($_id, $_horarioexame, $_dataexame, $_idpaciente, $_resultado, $_outroexame, $_idmedico, $_exames, $_resultadoexame, $_SESSION['user']);
        if (!empty($_erro)) {
            $_SESSION['erro'] =  $_erro;
            $_objeto->id = '';
            $_SESSION['registro'] = serialize($_objeto);
            header("Location: index.php?id=" . $_id);
        } else {
            $db = connectDB();
            $coll = $db->exames;
            $array = (array) $_objeto;
            $_termo = 'incluido';
            if ($_edicao) {
                $_termo = 'alterado';

                $query = array("_id" => $_id);
                $coll->update($query, $array);
            } else {
                $coll->insert($array);
            }

            $_SESSION['erro'] = makesuccesstoast('O exame foi ' . $_termo . ' na base de dados');
            header("Location: ../home/index.php");
        }
    } else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['id'])) {
            $_id = remove_inseguro($_GET['id']);
            $db = connectDB();
            $coll = $db->exames;
            $query = array("_id" => $_id);

            $r = $coll->findOne($query);

            if (count($r) > 0) {
                $_objeto = obtercadastroexame($r);
                $_SESSION['registro'] = serialize($_objeto);
                header("Location: index.php?id=" . $_id);
            } else {
                $_SESSION['erro'] = makeerrortoast("Exame não encontrado!");
                header("Location: ../home/index.php");
            }
        } else {
            $_SESSION['erro'] = makeerrortoast("Identificador não informado!");
            header("Location: ../home/index.php");
        }
    }
} catch (Throwable $e) {
    $_SESSION['erro'] = makeerrortoast($e->getMessage() . PHP_EOL);
    header("Location: ../home/index.php");
} catch (Exception $e) {
    $_SESSION['erro'] = makeerrortoast($e->getMessage() . PHP_EOL);
    header("Location: ../home/index.php");
}

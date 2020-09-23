<?php
session_start();

require_once '../tools/utilities.php';
require_once '../models/cadastro_model.php';
require_once '../database/db_instance.php';

try {

    $_id = $_idpaciente = $_sintomas_add =
        $_observacoes =
        $_data =
        $_horario =
        $_receita =
        $_erro = '';
    $_sintomas = array();
    $_objeto = null;
    $_edicao = false;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $_id = md5(uniqid(""));
        if (isset($_POST['identificador'])) {
            if (!empty($_POST["identificador"])) {
                $_id = remove_inseguro($_POST["identificador"]);
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
        if (isset($_POST['febre'])) {
            array_push($_sintomas, remove_inseguro($_POST["febre"]));
        }
        if (isset($_POST['dorcabeca'])) {
            array_push($_sintomas, remove_inseguro($_POST["dorcabeca"]));
        }
        if (isset($_POST['dorcorpo'])) {
            array_push($_sintomas, remove_inseguro($_POST["dorcorpo"]));
        }
        if (isset($_POST['dorpeito'])) {
            array_push($_sintomas, remove_inseguro($_POST["dorpeito"]));
        }
        if (isset($_POST['dorbarriga'])) {
            array_push($_sintomas, remove_inseguro($_POST["dorbarriga"]));
        }
        if (isset($_POST['vomito'])) {
            array_push($_sintomas, remove_inseguro($_POST["vomito"]));
        }
        if (isset($_POST['nausea'])) {
            array_push($_sintomas, remove_inseguro($_POST["nausea"]));
        }
        if (isset($_POST['formigamento'])) {
            array_push($_sintomas, remove_inseguro($_POST["formigamento"]));
        }
        if (isset($_POST['perdapeso'])) {
            array_push($_sintomas, remove_inseguro($_POST["perdapeso"]));
        }
        if (isset($_POST['ganhopeso'])) {
            array_push($_sintomas, remove_inseguro($_POST["ganhopeso"]));
        }
        if (isset($_POST['cansaco'])) {
            array_push($_sintomas, remove_inseguro($_POST["cansaco"]));
        }
        if (isset($_POST['outro'])) {
            array_push($_sintomas, remove_inseguro($_POST["outro"]));
        }
        if (isset($_POST['outrosintoma'])) {
            $_sintomas_add = remove_inseguro($_POST["outrosintoma"]);
        }
        if (isset($_POST['dataconsulta'])) {
            if (empty($_POST["dataconsulta"])) {
                $_erro .= 'Data não informada!<br>';
            } else {
                $_data = remove_inseguro($_POST["dataconsulta"]);
            }
        }
        if (isset($_POST['horarioconsulta'])) {
            if (empty($_POST["horarioconsulta"])) {
                $_erro .= 'Horário não informado!<br>';
            } else {
                $_horario = remove_inseguro($_POST["horarioconsulta"]);
            }
        }
        if (isset($_POST['receita'])) {
            if (empty($_POST["receita"])) {
                $_erro .= 'Receita aplicada não informada!<br>';
            } else {
                $_receita = remove_inseguro($_POST["receita"]);
            }
        }
        if (isset($_POST['observacoes'])) {
            if (empty($_POST["observacoes"])) {
                $_erro .= 'Observações da consulta não informadas!<br>';
            } else {
                $_observacoes = remove_inseguro($_POST["observacoes"]);
            }
        }
        $_objeto = new Consulta($_id, $_horario, $_data, $_idpaciente, $_observacoes, $_sintomas_add, $_SESSION['user'], $_sintomas, $_receita);
        if (!empty($_erro)) {
            $_SESSION['erro'] =  $_erro;
            $_objeto->id = '';
            $_SESSION['registro'] = serialize($_objeto);
            header("Location: index.php?id=" . $_id);
        } else {
            $db = connectDB();
            $coll = $db->consultas;
            $array = (array) $_objeto;
            $_termo = 'incluida';
            if ($_edicao) {
                $_termo = 'alterada';
                $query = array("_id" => $_id);
                $coll->update($query, $array);
            } else {
                $coll->insert($array);
            }

            $_SESSION['erro'] = makesuccesstoast('A consulta foi ' . $_termo . ' na base de dados');
            header("Location: ../home/index.php");
        }
    } else if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        if (isset($_GET['id'])) {
            $_id = remove_inseguro($_GET['id']);
            $db = connectDB();
            $coll = $db->consultas;
            $query = array("_id" => $_id);

            $r = $coll->findOne($query);

            if (count($r) > 0) {
                $_objeto = obtercadastroconsulta($r);
                $_SESSION['registro'] = serialize($_objeto);
                header("Location: index.php?id=" . $_id);
            } else {
                $_SESSION['erro'] = makeerrortoast("Consulta não encontrada!");
                header("Location: ../home/index.php");
            }
        } else {
            $_SESSION['erro'] = makeerrortoast("Identificador não informado");
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

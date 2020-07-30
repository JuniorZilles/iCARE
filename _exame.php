<?php
session_start();

require_once '_utilities.php';
require_once '_cadastro_model.php';


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
        $xmlString = file_get_contents('dados.xml');
        $xml = new SimpleXMLElement($xmlString);
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
                $_erro .= 'Nome não informado!<br>';
            } else {
                $_idmedico = remove_inseguro($_POST["medicoid"]);
            }
        }
        if (isset($_POST['exame'])) {
            if (empty($_POST["exame"])) {
                $_erro .= 'Nenhum exame foi selecionado!<br>';
            } else {
                $_exames = remove_inseguro($_POST["exame"]);
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
            header("Location: cadastro_exame.php");
        } else {
            $array = (array) $_objeto;
            $_termo = 'incluido';
            if ($_edicao) {
                $_termo = 'alterado';
                $exame = $xml->xpath("//exame[id = '$_id']");

                foreach ($exame[0] as $k => $v) {
                    if ($k == 'tipoexame') {
                        $exame[0]->$k = '';
                        $nodo = $exame[0]->$k;
                        $tipos = explode(",", (string) $array[$k]);
                        foreach ($tipos as $tp) {
                            if (!empty($tp))
                                $nodo->addChild('tipo', $tp);
                        }
                    } else
                        $exame[0]->$k = (string) $array[$k];
                }
            } else {
                $exame = $xml->exames->addChild('exame');

                foreach ($array as $k => $v) {
                    if ($k == 'tipoexame') {
                        $nos = $exame->addChild($k);
                        $tipos = explode(",", $v);
                        foreach ($tipos as $tp) {
                            if (!empty($tp))
                                $nos->addChild('tipo', $tp);
                        }
                    } else
                        $exame->addChild($k, $v);
                }
            }
            $xml->asXML('dados.xml');

            $_SESSION['erro'] = makesuccesstoast('O exame foi ' . $_termo . ' na base de dados');
            header("Location: home.php");
        }
    } else if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        if (isset($_GET['id'])) {
            $_id = remove_inseguro($_GET['id']);
        } else {
            
        }
        $xml = simplexml_load_file('dados.xml');

        $nodoexame = $xml->xpath("//exame[id = '" . $_id . "']");
        
        if (count($nodoexame) > 0) {
            $_objeto = obtercadastroexame($nodoexame[0]);
        }
        
        $_SESSION['registro'] = serialize($_objeto);
        header("Location: cadastro_exame.php");
    }
} catch (Throwable $e) {
    $_SESSION['erro'] = maketoast('Erro de execução', $e->getMessage() . PHP_EOL);
    header("Location: home.php");
} catch (Exception $e) {
    $_SESSION['erro'] = maketoast('Erro de execução', $e->getMessage() . PHP_EOL);
    header("Location: home.php");
}

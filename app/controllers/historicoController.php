<?php
require_once 'app/tools/utilities.php';

class HistoricoController extends Controller
{
    public function index()
    {
        $this->carregarTemplate('erro');
    }

    public function consulta()
    {
        try {
            if (!isset($_SESSION['user'])) {
                $_SESSION['erro'] = makeerrortoast('Usuário não logado');
                header('Location: ../index.php?pag=Login');
            } else {
                $_id = '';
                $_tipo = $_SESSION['tipo'];
                if ($_tipo != 'admin') $_id = $_SESSION['user'];
                $hisModel = new HistoricoModel();
                $dados = $hisModel->getConsultas($_id, '', $_tipo);

                $this->carregarTemplate('historicoConsulta', $dados);
            }
        } catch (Exception $e) {
            $_SESSION['erro'] = makeerrortoast($e->getMessage());
            header('Location: ../index.php?pag=Home');
        }
    }

    public function exame()
    {
        try {
            if (!isset($_SESSION['user'])) {
                $_SESSION['erro'] = makeerrortoast('Usuário não logado');
                header('Location: ../index.php?pag=Login');
            } else {
                $_id = '';
                $_tipo = $_SESSION['tipo'];

                if ($_tipo != 'admin') $_id = $_SESSION['user'];

                $hisModel = new HistoricoModel();
                $dados = $hisModel->getExames($_id, '', $_tipo);

                $this->carregarTemplate('historicoExame', $dados);
            }
        } catch (Exception $e) {
            $_SESSION['erro'] = makeerrortoast($e->getMessage());
            header('Location: ../index.php?pag=Home');
        }
    }

    public function postHistorico()
    {
        try {
            if (!isset($_SESSION['user'])) {
                $_SESSION['erro'] = makeerrortoast('Usuário não logado');
                header('Location: ../index.php?pag=Login');
            } elseif ($_SESSION['tipo'] == 'paciente') {
                $_SESSION['erro'] = makeerrortoast('Usuário não permitido');
                header('Location: ../index.php?pag=Home');
            } else {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $_id = $_pacienteid = $_opcao = '';
                    $_tipo = $_SESSION['tipo'];
                    if (isset($_POST['pacienteid'])) {
                        if (!empty($_POST["pacienteid"])) {
                            $_pacienteid = remove_inseguro($_POST["pacienteid"]);
                        }
                    }
                    if (isset($_POST['opcao'])) {
                        if (!empty($_POST["opcao"])) {
                            $_opcao = remove_inseguro($_POST["opcao"]);
                        }
                    }
                    if ($_tipo != 'admin') $_id = $_SESSION['user'];

                    $hisModel = new HistoricoModel();

                    if ($_opcao == 'consulta') {
                        $dados = $hisModel->getConsultas($_id, $_pacienteid, $_tipo);
                        $this->carregarTemplate('historicoConsulta', $dados);
                    } elseif ($_opcao == 'exame') {
                        $dados = $hisModel->getExames($_id, $_pacienteid, $_tipo);
                        $this->carregarTemplate('historicoExame', $dados);
                    } else {
                        $this->carregarTemplate('erro');
                    }
                } else {
                    header('Location: ../index.php?pag=Home');
                }
            }
        } catch (Exception $e) {
            $_SESSION['erro'] = makeerrortoast($e->getMessage());
            header('Location: ../index.php?pag=Home');
        }
    }
}

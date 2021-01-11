<?php
require_once 'app/tools/utilities.php';

class VisualizacaoController extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['user'])) {
            $_SESSION['erro'] = makeerrortoast('Usuário não logado');
            header('Location: ../index.php?pag=Login');
        } elseif ($_SESSION['tipo'] != 'admin') {
            $_SESSION['erro'] = makeerrortoast('Usuário não permitido');
            header('Location: ../index.php?pag=Home');
        } else {
            $model = new VisualizacaoModel();
            $dado = $model->getPessoas();
            $this->carregarTemplate('visualizacao', array($dado));
        }
    }
}

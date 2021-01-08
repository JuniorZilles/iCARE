<?php
    class EstatisticasController extends Controller{
        public function index(){
            if (!isset($_SESSION['user'])) {
                $_SESSION['erro'] = makeerrortoast('Usuário não logado');
                header('Location: ../index.php?pag=Login');
            }else{
                $esModel = new EstatisticaModel();
                $dados = $esModel->getStatistics($_SESSION['user'], $_SESSION['tipo']);
                $this->carregarTemplate('estatisticas', $dados);
            }
        }
    }
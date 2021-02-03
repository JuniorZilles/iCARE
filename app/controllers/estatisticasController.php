<?php
class EstatisticasController extends Controller
{
    public function index()
    {
        try {
            if (!isset($_SESSION['user'])) {
                $_SESSION['erro'] = makeerrortoast('Usuário não logado');
                header('Location: ../index.php?pag=Login');
            } else {
                $esModel = new EstatisticaModel();
                $dados = $esModel->getStatistics($_SESSION['user'], $_SESSION['tipo']);
                $this->carregarTemplate('estatisticas', $dados);
            }
        } catch (Exception $e) {
            $_SESSION['erro'] = makeerrortoast($e->getMessage());
            header('Location: ../index.php?pag=Home');
        }
    }
}

<?php
require_once 'app/tools/utilities.php';

class LogoutController extends Controller
{
    public function index()
    {
        setcookie("user", "", time() - 3600, "/");
        unset($_SESSION['tipo']);
        unset($_SESSION['user']);
        
        $_SESSION['erro'] = makesuccesstoast('Sessão Encerrada', 'Você saiu, para obter acesso faça login novamente!');
        $controller = 'LoginController';
        $c = new $controller;
        call_user_func_array(array($c, 'index'), array());
    }
}

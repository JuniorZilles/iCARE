<?php
class Controller
{
    public $dados;

    public function __construct()
    {
        $this->dados = array();
    }

    public function carregarTemplate($nomeView, $dadosModel = array())
    {
        $this->dados = $dadosModel;
        $path = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/124905-124907/';
        require 'app/views/template.php';
    }

    public function carregarViewNoTemplate($nomeView, $dadosModel = array(), $path)
    {
        extract($dadosModel);
        require 'app/views/' . $nomeView . '.php';
    }

    public function carregarCabecalhoNoTemplate($path)
    {
        require 'app/tools/menu.php';
        require 'app/views/menu.php';
    }
}

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
        $path = 'http://localhost/trabalho_si/';
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

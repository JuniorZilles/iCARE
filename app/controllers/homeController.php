<?php
    class HomeController extends Controller{
        public function index(){
            if (isset($_SESSION['user']) &&
            isset($_SESSION['tipo'])){
                $this->carregarTemplate('home');
            }else{
                header('Location: ./index.php?pag=Login');
            }
        }
    }
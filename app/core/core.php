<?php
    class Core
    {

        public function __construct()
        {
            $this->start();
        }
        public function start(){
            $parametros = null;
            $usercls = new User();
            $usercls->user();
            $controller = 'LoginController';
            $metodo = 'index';

            if (isset($_GET['pag'])){
                $url = ucfirst($_GET['pag']);
            }

            if (!empty($url)){
                $url = explode('/', $url);
                $controller = $url[0].'Controller';

                array_shift($url);

                if (isset($url[0]) && !empty($url[0])){
                    $metodo = $url[0];
                    array_shift($url);
                }else{
                    $metodo = 'index';
                }

                if (count($url)>0){
                    $parametros = $url;
                }
            }
            
            if(!method_exists($controller, $metodo)){
                $controller = 'ErrorController';
                $metodo = 'index';
            }

            $c = new $controller;
            call_user_func_array(array($c, $metodo), array($parametros));
        }

        
    }
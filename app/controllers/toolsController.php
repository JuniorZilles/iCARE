<?php
    require_once 'app/tools/utilities.php';

    class ToolsController extends Controller{
        public function index(){
            echo json_encode('Não disponível');
        }

        public function cadastro(){
            if(isset($_SESSION['user'])){
                $model = new ToolsModel();
                $esp = $model->getEspecialidades();
                $est = $model->getEstados();
                $exa = $model->getTipoExames();
                echo json_encode(new Autocomplete($exa, $est, $esp));
            }else{
                echo json_encode('Não permitido');
            }
        }

        public function medicos(){
            if(isset($_SESSION['user'])){
                $model = new ToolsModel();
                $med = $model->getMedicos();
                echo json_encode($med);
            }else{
                echo json_encode('Não permitido');
            }
        }

        public function pacientes(){
            if(isset($_SESSION['user'])){
                $model = new ToolsModel();
                $med = $model->getPacientes();
                echo json_encode($med);
            }else{
                echo json_encode('Não permitido');
            }
        }

        public function laboratorioTipoExame($params)
        {
            if(isset($_SESSION['user'])){
                $id = remove_inseguro($params[0]);
                $model = new ToolsModel();
                $exa = $model->getLabTipoExame($id);
                echo json_encode($exa);
            }else{
                echo json_encode('Não permitido');
            }
        }
    }
<?php
class HistoricoModel
{   
    private $db;

    public function __construct()
    {
        $this->db = Conexao::getConexao();
    }

    public function getConsultas($_id, $_pacienteid, $_tipo)
    {
        $_objeto = array();
        $_exame_consulta = array();

        if (!empty($_id) && !empty($_pacienteid) && $_tipo == 'medico') {
            $coll = $this->db->consultas;
            $query = array('$and' => array(array('medicoid' => $_id), array('pacienteid' => $_pacienteid)));
            $_exame_consulta = $coll->find($query);
        } elseif (!empty($_id) && $_tipo == 'medico') {
            $coll = $this->db->consultas;
            $query = array("medicoid" => $_id);
            $_exame_consulta = $coll->find($query);
        } elseif (!empty($_id) && $_tipo == 'paciente') {
            $coll = $this->db->consultas;
            $query = array("pacienteid" => $_id);
            $_exame_consulta = $coll->find($query);
        } elseif (!empty($_pacienteid) && $_tipo == 'admin') {
            $coll = $this->db->consultas;
            $query = array("pacienteid" => $_pacienteid);
            $_exame_consulta = $coll->find($query);
        } elseif ($_tipo == 'admin') {
            $coll = $this->db->consultas;
            $_exame_consulta = $coll->find();
        }

        $_exame_consulta->sort(array('data' => -1));
        
        foreach ($_exame_consulta as $item) {
            $_regitro = new RegistroModel();
            
            $_regitro->consulta_exame = $this->obter_visualizacao_consulta($item);
            
            $_pacid = (string)$item['pacienteid'];
            $pac = $this->getUser($_pacid);
            $_regitro->paciente = $this->obter_usuario_visualizacao($pac);

            $_medicid = (string)$item['medicoid'];
            $medic = $this->getUser($_medicid);
            $_regitro->medico = $this->obter_usuario_visualizacao($medic);

            array_push($_objeto, $_regitro);
            $_regitro = null;
        }
        return $_objeto;
    }

    public function getExames($_id, $_pacienteid, $_tipo)
    {
        $_objeto = array();
        $_exame_consulta = array();

        if (!empty($_id) && !empty($_pacienteid) && $_tipo == 'laboratorio') {
            $coll = $this->db->exames;
            $query = array('$and' => array(array('laboratorioid' => $_id), array('pacienteid' => $_pacienteid)));
            $_exame_consulta = $coll->find($query);
        } elseif (!empty($_id) && $_tipo == 'laboratorio') {
            $coll = $this->db->exames;
            $query = array("laboratorioid" => $_id);
            $_exame_consulta = $coll->find($query);
        } elseif (!empty($_id) &&  $_tipo == 'paciente') {
            $coll = $this->db->exames;
            $query = array("pacienteid" => $_id);
            $_exame_consulta = $coll->find($query);
        } elseif (!empty($_pacienteid) &&  $_tipo == 'admin') {
            $coll = $this->db->exames;
            $query = array("pacienteid" => $_pacienteid);
            $_exame_consulta = $coll->find($query);
        } elseif ($_tipo == 'admin') {
            $coll = $this->db->exames;
            $_exame_consulta = $coll->find();
        }
        $_exame_consulta->sort(array('data' => -1));

        foreach ($_exame_consulta as $item) {
            $_regitro = new RegistroModel();
            
            $_labid = (string)$item['laboratorioid'];
            $lab = $this->getUser($_labid);
            $_regitro->laboratorio = $this->obter_usuario_visualizacao($lab);
            $_regitro->consulta_exame = $this->obter_visualizacao_exame($item);
           
            $_pacid = (string)$item['pacienteid'];
            $pac = $this->getUser($_pacid);
            $_regitro->paciente = $this->obter_usuario_visualizacao($pac);

            $_medicid = (string)$item['medicoid'];
            $medic = $this->getUser($_medicid);
            $_regitro->medico = $this->obter_usuario_visualizacao($medic);
            array_push($_objeto, $_regitro);
            $_regitro = null;
        }
        return $_objeto;
    }

    public function getUser($id){
        $coll = $this->db->users;
        $query = array("_id" => $id);
        $user = $coll->findOne($query);
        return $user;
    }

    public function obter_visualizacao_consulta($child)
    {
        $_id = (string)$child['_id'];
        $_hora = (string)$child['hora'];
        $_data = (string)$child['data'];
        $_pacienteid = (string)$child['pacienteid'];
        $_observacao = (string)$child['observacao'];
        $_medicoid = (string)$child['medicoid'];
        $_outro = (string)$child['outro'];
        $_sintomas = $this->obter_child_visualizacao($child['sintomas']);
        $_receita = (string)$child['receita'];
        return new ConsultaModel($_id, $_hora, $_data, $_pacienteid, $_observacao, $_outro, $_medicoid, $_sintomas, $_receita);
    }

    public function obter_usuario_visualizacao($child)
    {
        $_tipo = (string)$child['tipo'];
        $_id = (string)$child['_id'];
        $_email = (string)$child['email'];
        $_nome = (string)$child['nome'];
        $_telefone = (string)$child['telefone'];
        $_rua = (string)$child['rua'];
        $_numero = (string)$child['numero'];
        $_bairro = (string)$child['bairro'];
        $_complemento = (string)$child['complemento'];
        $_cidade = (string)$child['cidade'];
        $_estado = (string)$child['estado'];
        $_cep = (string)$child['cep'];
        if ($_tipo == 'medico') {
            $_especialidade = (string)$child['especialidade'];
            $_crm = (string)$child['crm'];
            return new MedicoModel($_id, $_tipo, $_nome, $_telefone, $_rua, $_numero, $_bairro, $_complemento, $_cidade, $_estado, $_cep, $_email, "", $_especialidade, $_crm);
        } else if ($_tipo == 'paciente') {
            $_genero = (string)$child['genero'];
            $_datanascimento = (string)$child['datanascimento'];
            $_cpf = (string)$child['cpf'];
            return new PacienteModel($_id, $_tipo, $_nome, $_telefone, $_rua, $_numero, $_bairro, $_complemento, $_cidade, $_estado, $_cep, $_email, "", $_genero, $_datanascimento, $_cpf);
        } else if ($_tipo == 'laboratorio') {
            $_tipoexame = $this->obter_child_visualizacao($child['tipoexame']);
            $_cnpj = (string)$child['cnpj'];
            return new LaboratorioModel($_id, $_tipo, $_nome, $_telefone, $_rua, $_numero, $_bairro, $_complemento, $_cidade, $_estado, $_cep, $_email, "", $_tipoexame, $_cnpj);
        }
    }

    public function obter_visualizacao_exame($child)
    {
        $_id = (string)$child['_id'];
        $_hora = (string)$child['hora'];
        $_data = (string)$child['data'];
        $_pacienteid = (string)$child['pacienteid'];
        $_observacao = (string)$child['observacao'];
        $_medicoid = (string)$child['medicoid'];
        $_outro = (string)$child['outro'];
        $_resultado = (string)$child['resultado'];
        $_laboratorioid = (string)$child['laboratorioid'];
        $_tipoexame = $this->obter_child_visualizacao($child['tipoexame']);
        return new ExameModel($_id, $_hora, $_data, $_pacienteid, $_observacao, $_outro, $_medicoid, $_tipoexame, $_resultado, $_laboratorioid);
    }

    private function obter_child_visualizacao($children)
    {
        $_val = '';
        foreach ($children as $k => $child) {
            $_val .= (string)$child . '<br/>';
        }
        return $_val;
    }
}

<?php

class CadastroModel
{
    private $db;

    public function __construct()
    {
        $this->db = Conexao::getConexao();
    }

    public function checkName($name)
    {
        $coll = $this->db->users;
        $query = array("nome" => new MongoRegex('/' . $name . '/i'));
        $r = $coll->findOne($query);
        return $r;
    }

    public function checkMail($email)
    {
        $coll = $this->db->users;
        $query = array("email" => new MongoRegex('/' . $email . '/i'));
        $r = $coll->findOne($query);
        return $r;
    }

    public function updateUser($array, $id)
    {
        $coll = $this->db->users;
        $query = array("_id" => $id);
        $coll->update($query, $array);
    }

    public function insertUser($array)
    {
        $coll = $this->db->users;
        $coll->insert($array);
    }

    public function updateExame($array, $id)
    {
        $coll = $this->db->exames;
        $query = array("_id" => $id);
        $coll->update($query, $array);
    }

    public function insertExame($array)
    {
        $coll = $this->db->exames;
        $coll->insert($array);
    }

    public function updateConsulta($array, $id)
    {
        $coll = $this->db->consultas;
        $query = array("_id" => $id);
        $coll->update($query, $array);
    }

    public function insertConsulta($array)
    {
        $coll = $this->db->consultas;
        $coll->insert($array);
    }

    public function getUser($id)
    {
        $coll = $this->db->users;
        $query = array("_id" => $id);
        $r = $coll->findOne($query);
        return $r;
    }

    public function getExame($id)
    {
        $coll = $this->db->exames;
        $query = array("_id" => $id);
        $r = $coll->findOne($query);
        return $r;
    }

    public function getConsulta($id)
    {
        $coll = $this->db->consultas;
        $query = array("_id" => $id);
        $r = $coll->findOne($query);
        return $r;
    }

    public function obterCadastroConsulta($child)
    {
        $_id = (string)$child['_id'];
        $_hora = (string)$child['hora'];
        $_data = (string)$child['data'];
        $_pacienteid = (string)$child['pacienteid'];
        $_observacao = (string)$child['observacao'];
        $_medicoid = (string)$child['medicoid'];
        $_outro = (string)$child['outro'];
        $_sintomas = $this->obterSintomas($child['sintomas']);
        $_receita = (string)$child['receita'];
        return new ConsultaModel($_id, $_hora, $_data, $_pacienteid, $_observacao, $_outro, $_medicoid, $_sintomas, $_receita);
    }

    public function obterCadastroExame($child)
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
        $_tipoexame = $this->obterExames($child['tipoexame']);
        return new ExameModel($_id, $_hora, $_data, $_pacienteid, $_observacao, $_outro, $_medicoid, $_tipoexame, $_resultado, $_laboratorioid);
    }

    public function obterCadastroUsuario($child)
    {
        $_tipo = (string)$child['tipo'];
        $_id = (string)$child['_id'];
        $_senha = (string)$child['senha'];
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
            return new MedicoModel($_id, $_tipo, $_nome, $_telefone, $_rua, $_numero, $_bairro, $_complemento, $_cidade, $_estado, $_cep, $_email, $_senha, $_especialidade, $_crm);
        } else if ($_tipo == 'paciente') {
            $_genero = (string)$child['genero'];
            $_datanascimento = (string)$child['datanascimento'];
            $_cpf = (string)$child['cpf'];
            return new PacienteModel($_id, $_tipo, $_nome, $_telefone, $_rua, $_numero, $_bairro, $_complemento, $_cidade, $_estado, $_cep, $_email, $_senha, $_genero, $_datanascimento, $_cpf);
        } else if ($_tipo == 'laboratorio') {
            $_tipoexame = $this->obterExames($child['tipoexame']);
            $_cnpj = (string)$child['cnpj'];
            return new LaboratorioModel($_id, $_tipo, $_nome, $_telefone, $_rua, $_numero, $_bairro, $_complemento, $_cidade, $_estado, $_cep, $_email, $_senha, $_tipoexame, $_cnpj);
        }
    }

    public function obterExames($exames)
    {
        $_tipoexame = '';
        foreach ($exames as $k => $child) {
            $_tipoexame .= (string)$child . ',';
        }
        return $_tipoexame;
    }

    public function obterSintomas($sintomas)
    {
        $_sintoms = array();
        foreach ($sintomas as $k => $child) {
            array_push($_sintoms, (string)$child);
        }
        return $_sintoms;
    }
}

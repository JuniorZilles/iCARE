<?php
class ToolsModel
{
    private $db;

    public function __construct()
    {
        $this->db = Conexao::getConexao();
    }

    public function getEspecialidades()
    {

        $espec = $this->db->especialidades;

        $r = $espec->find();

        $specialities = array();
        foreach ($r as $item) {
            array_push($specialities, (string)$item['nome']);
        }

        return $specialities;
    }

    public function getEstados()
    {

        $estad = $this->db->estados;

        $r = $estad->find();

        $states = array();
        foreach ($r as $item) {
            array_push($states, new EstadoModel((string)$item['sigla'], (string)$item['nome']));
        }

        return $states;
    }

    public function getTipoExames()
    {

        $tipexam = $this->db->tipoexames;

        $r = $tipexam->find();

        $exams = array();
        foreach ($r as $item) {
            array_push($exams, (string)$item['nome']);
        }

        return $exams;
    }

    public function getLabTipoExame($id)
    {
        $query = array("_id" => $id);
        $selec = array("tipoexame");
        $coll = $this->db->users;

        $r = $coll->findOne($query, $selec);

        return $r['tipoexame'];
    }

    public function getMedicos()
    {
        $array = array();

        $query = array("tipo" => "medico");
        $selec = array("_id", "nome", "especialidade", "crm", "telefone");
        $coll = $this->db->users;

        $r = $coll->find($query, $selec);
        foreach ($r as $item) {
            array_push($array, new MedicoAutoModel((string)$item['_id'], (string)$item['nome'], (string)$item['especialidade'], (string)$item['crm'], (string)$item['telefone']));
        }

        return $array;
    }

    public function getPacientes()
    {
        $array = array();

        $query = array("tipo" => "paciente");
        $selec = array("_id", "nome", "datanascimento");
        $coll = $this->db->users;

        $r = $coll->find($query, $selec);
        foreach ($r as $item) {
            array_push($array, new PacienteAutoModel((string)$item['_id'], (string)$item['nome'], (string)$item['datanascimento']));
        }

        return $array;
    }
}

class Autocomplete
{
    public
        $exames,
        $estados,
        $especialidades;

    public function __construct($s, $n, $e)
    {
        $this->exames = $s;
        $this->estados = $n;
        $this->especialidades = $e;
    }
}

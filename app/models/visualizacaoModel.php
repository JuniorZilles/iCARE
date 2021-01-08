<?php
class VisualizacaoModel
{
    private $db;

    public function __construct()
    {
        $this->db = Conexao::getConexao();
    }
    
    public function getPessoas(){

        $selec = array("_id", "nome", "email", "tipo", "telefone");
        $coll = $this->db->users;
        $query = array('tipo' => array('$not' =>  new MongoRegex("/admin/i")));
        $r = $coll->find($query, $selec);
        return $r;
    }
}
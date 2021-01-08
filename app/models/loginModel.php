<?php 

class LoginModel{
    private $db;

    public function __construct()
    {
        $this->db = Conexao::getConexao();
    }

    public function getUser($email, $senha){
    
        $collection = $this->db->users;

        $query = array('$and' => array(array('email' => $email), array('senha' => $senha)));

        $selec = array("_id", "tipo");

        $r = $collection->findOne($query, $selec);

        return $r;
    }

    public function getUserById($id){
    
        $collection = $this->db->users;

        $query = array('_id' => $id);

        $selec = array("_id", "tipo");

        $r = $collection->findOne($query, $selec);

        return $r;
    }
}
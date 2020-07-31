<?php
Class Medico{
    public $id,
    $nome,
    $telefone,
    $especialidade,
    $crm;

    public function __construct($i, $n, $e, $c, $t)
        {
            $this->id = $i;
            $this->nome = $n;
            $this->telefone = $t;
            $this->especialidade = $e;
            $this->crm = $c;
        }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $xmlString = file_get_contents('dados.xml');
    $xml = new SimpleXMLElement($xmlString);
    $user = $xml->xpath("//user[tipo = 'medico']");
    $array = array();
    foreach ($user as $item) {
        array_push($array, new Medico((string)$item->id,(string)$item->nome, (string)$item->especialidade, (string)$item->crm, (string)$item->telefone));
    }
    echo json_encode($array);
}
?>

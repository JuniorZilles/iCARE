<?php
Class Paciente{
    public $id,
    $datanascimento,
    $nome;

    public function __construct($i, $n, $d)
        {
            $this->id = $i;
            $this->datanascimento = $d;
            $this->nome = $n;
        }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $xmlString = file_get_contents('dados.xml');
    $xml = new SimpleXMLElement($xmlString);
    $user = $xml->xpath("//user[tipo = 'paciente']");
    $array = array();
    foreach ($user as $item) {
        array_push($array, new Paciente((string)$item->id,(string)$item->nome, (string)$item->datanascimento));
    }
    echo json_encode($array);
}
?>

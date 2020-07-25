<?php
Class Medico{
    public $id,
    $nome;

    public function __construct($i, $n)
        {
            $this->id = $i;
            $this->nome = $n;
        }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $xmlString = file_get_contents('dados.xml');
    $xml = new SimpleXMLElement($xmlString);
    $user = $xml->xpath("//user[tipo = 'medico']");
    $array = array();
    foreach ($user as $item) {
        array_push($array, new Medico((string)$item->id,(string)$item->nome));
    }
    echo json_encode($array);
}
?>

<?php
require_once '../database/db_instance.php';
require_once '../models/tools_model.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $db = connectDB();
    $array = array();

    $query = array("tipo" => "medico");
    $selec = array("_id", "nome", "especialidade", "crm", "telefone");
    $coll = $db->users;

    $r = $coll->find($query, $selec);
    foreach ($r as $item) {
        array_push($array, new Medico((string)$item['_id'], (string)$item['nome'], (string)$item['especialidade'], (string)$item['crm'], (string)$item['telefone']));
    }
    echo json_encode($array);
}

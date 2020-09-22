<?php
require_once '../database/db_instance.php';
require_once '../models/tools_model.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $db = connectDB();
    $array = array();

    $query = array("tipo" => "paciente");
    $selec = array("_id", "nome", "datanascimento");
    $coll = $db->users;

    $r = $coll->find($query, $selec);
    foreach ($r as $item) {
        array_push($array, new Paciente((string)$item['_id'], (string)$item['nome'], (string)$item['datanascimento']));
    }
    echo json_encode($array);
}

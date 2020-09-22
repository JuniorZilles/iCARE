<?php
require_once '../database/db_instance.php';
require_once '../models/tools_model.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $db = connectDB();
    $array = array();

    $espec = $db->especialidades;

    $r = $espec->find();

    $specialities = array();
    foreach ($r as $item) {
        array_push($specialities, (string)$item['nome']);
    }

    $estad = $db->estados;

    $r = $estad->find();

    $states = array();
    foreach ($r as $item) {
        array_push($states, new Estado((string)$item['sigla'], (string)$item['nome']));
    }

    $tipexam = $db->tipoexames;

    $r = $tipexam->find();

    $exams = array();
    foreach ($r as $item) {
        array_push($exams, (string)$item['nome']);
    }

    echo json_encode(new Autocomplete($exams, $states, $specialities));
}

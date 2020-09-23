<?php
require_once '../database/db_instance.php';
require_once 'utilities.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $_id = remove_inseguro($_GET['id']);
        $db = connectDB();

        $query = array("_id" => $_id);
        $selec = array("tipoexame");
        $coll = $db->users;

        $r = $coll->findOne($query, $selec);
        echo json_encode($r['tipoexame']);
    }
}

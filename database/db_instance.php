<?php

function connectDB()
{
    $_server = "192.168.56.101";
    $_user = "root";
    $_pass = "MongoDB2020";
    $_port = "27017";
    try {
        $conn = new MongoClient("mongodb://$_user:$_pass@$_server:$_port");
        //$conn = new MongoClient("localhost:$_port");
        $db = $conn->database_jardel_junior;
        $arr = $db->getCollectionNames();
        $posi = array_search('users', $arr);
        if ($posi === false) {
            initCollections($db);
        }
        return $db;
        //return $conn;
    } catch (MongoConnectionException $e) {
        die($e->getMessage());
    }
}

function initCollections($connection)
{
    try {
        insertData($connection, 'users');
        insertData($connection, 'exames');
        insertData($connection, 'consultas');
        insertData($connection, 'especialidades');
        insertData($connection, 'estados');
        insertData($connection, 'tipoexames');
    } catch (MongoConnectionException $e) {
        die($e->getMessage());
    }
}

function insertData($connection, $collectionName)
{
    try {
        $collection = $connection->createCollection($collectionName);
        $dump = getDBdump($collectionName);
        $dump = $dump->$collectionName;
        foreach ($dump as $line) {
            $collection->insert((array)$line);
        }
    } catch (MongoConnectionException $e) {
        die($e->getMessage());
    }
}

function getDBdump($collectionName)
{
    $str = file_get_contents('dump/' . $collectionName . '.json');
    $json = json_decode($str);
    return $json;
}

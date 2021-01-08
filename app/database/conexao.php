<?php
class Conexao
{
    private static $db;

    private function __construct(){ }

    public static function getConexao()
    {
        if(!isset(self::$db)){
            $_server = "192.168.56.101";
            $_user = "root";
            $_pass = "MongoDB2020";
            $_port = "27017";
            try {
                $conn = new MongoClient("mongodb://$_user:$_pass@$_server:$_port");
                //$conn = new MongoClient("localhost:$_port");
                self::$db = $conn->database_jardel_junior;
                $arr = self::$db->getCollectionNames();
                $posi = array_search('users', $arr);
                if ($posi === false) {
                    $this->initCollections();
                }
            } catch (MongoConnectionException $e) {
                die($e->getMessage());
            }
        }
        return self::$db;
    }

    public function initCollections()
    {
        $this->insertData('users');
        $this->insertData('exames');
        $this->insertData('consultas');
        $this->insertData('especialidades');
        $this->insertData('estados');
        $this->insertData('tipoexames');
    }

    public function insertData($collectionName)
    {
        $collection = self::$db->createCollection($collectionName);
        $dump = $this->getDBdump($collectionName);
        $dump = $dump->$collectionName;
        foreach ($dump as $line) {
            $collection->insert((array)$line);
        }
    }

    public function getDBdump($collectionName)
    {
        $str = file_get_contents('dump/' . $collectionName . '.json');
        $json = json_decode($str);
        return $json;
    }
}

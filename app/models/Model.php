<?php

namespace app\models;

use PDO;

class Model {

    protected $db1;  
    protected $db2;  
    protected $db3; 
    
    public function __construct() {
        $this->db1 = $this->connectToDB1();
        $this->db2 = $this->connectToDB2();
        $this->db3 = $this->connectToDB3();
    }

    // Connect to the first database (portfolio)
    private function connectToDB1() {
        try {
            $dsn = "mysql:host=" . DB1HOST . ";port=" . DB1PORT . ";dbname=" . DB1NAME;
            $db = new PDO($dsn, DB1USER, DB1PASS);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (\Exception $e) {
            die("Connection failed to DB1: " . $e->getMessage());
        }
    }

    // Connect to the second database (contact messages)
    private function connectToDB2() {
        try {
            $dsn = "mysql:host=" . DB2HOST . ";port=" . DB2PORT . ";dbname=" . DB2NAME;
            $db = new PDO($dsn, DB2USER, DB2PASS);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (\Exception $e) {
            die("Connection failed to DB2: " . $e->getMessage());
        }
    }

    // Connect to the third database (contact messages)
    private function connectToDB3() {
        try {
            $dsn = "mysql:host=" . DB3HOST . ";port=" . DB3PORT . ";dbname=" . DB3NAME;
            $db = new PDO($dsn, DB3USER, DB3PASS);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (\Exception $e) {
            die("Connection failed to DB3: " . $e->getMessage());
        }
    }
}
?>
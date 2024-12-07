<?php

namespace app\models;

use PDO; 

class PortfolioModel {

    private $db;

    public function __construct() {
        $dbHost = DB1HOST;
        $dbUser = DB1USER;   
        $dbPass = DB1PASS;
        $dbName = DB1NAME;

        try {
            $this->db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\Exception $e) {
            die("Could not connect to the database: " . $e->getMessage());
        }
    }

    public function getAllProjects() {
        $stmt = $this->db->query("SELECT title, description, image_url FROM projects");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>









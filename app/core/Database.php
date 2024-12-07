<?php

namespace app\core;

use PDO;
use PDOException;

class Database {

    private $host;
    private $user;
    private $pass;
    private $dbname;
    private $port;

    public function __construct($host, $user, $pass, $dbname, $port) {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->dbname = $dbname;
        $this->port = $port;
    }

    public function connect() {
        try {
            $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->dbname}";
            $connection = new PDO($dsn, $this->user, $this->pass);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}
?>

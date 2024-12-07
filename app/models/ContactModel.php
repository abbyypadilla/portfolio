<?php

namespace app\models;

require_once __DIR__ . '/../core/Database.php';

use app\core\Database;

class ContactModel {
    private $db;

    public function __construct() {
        $this->db = new Database(DB2HOST, DB2USER, DB2PASS, DB2NAME, DB2PORT);  
    }

    public function saveContact($name, $email, $message) {
        $name = htmlspecialchars(strip_tags($name));
        $email = htmlspecialchars(strip_tags($email));
        $message = htmlspecialchars(strip_tags($message));

        $query = "INSERT INTO messages (name, email, message) 
                  VALUES (:name, :email, :message)";

        $connection = $this->db->connect();

        $stmt = $connection->prepare($query);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>

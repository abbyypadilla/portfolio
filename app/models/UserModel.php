<?php
namespace app\models;

use PDO;

class UserModel
{
    private $db;

    public function __construct()
    {
        $dsn = 'mysql:host=' . DB3HOST . ';dbname=' . DB3NAME;
        $username = DB3USER;
        $password = DB3PASS;
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,  
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
            PDO::ATTR_EMULATE_PREPARES => false,  
        ];

        try {
            $this->db = new PDO($dsn, $username, $password, $options);
        } catch (\PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            exit;  
        }
    }

    public function saveUser($username, $email, $password)
    {
        try {
            $query = "INSERT INTO profiles (username, email, password) VALUES (:username, :email, :password)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);   

            return $stmt->execute();
        } catch (\PDOException $e) {
            return false; 
        }
    }

    public function doesUsernameExist($username)
    {
        $query = "SELECT COUNT(*) FROM profiles WHERE username = :username";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['username' => $username]);
        
        return $stmt->fetchColumn() > 0;
    }

    public function doesEmailExist($email)
    {
        $query = "SELECT COUNT(*) FROM profiles WHERE email = :email"; 
        $stmt = $this->db->prepare($query);
        $stmt->execute(['email' => $email]);
        return $stmt->fetchColumn() > 0;
    }

    // Get user by username
    public function getUserByUsername($username)
    {
        try {
            $query = "SELECT * FROM profiles WHERE username = :username";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                return $user;  
            } else {
                return false;  
            }
        } catch (\PDOException $e) {
            return false;  
        }
    }

    public function getUserByEmail($email)
    {
        try {
            $query = "SELECT * FROM profiles WHERE email = :email";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                return $user;  
            } else {
                return false;  
            }
        } catch (\PDOException $e) {
            return false;  
        }
    }
}




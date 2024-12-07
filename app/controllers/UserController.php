<?php

namespace app\controllers;

use app\models\UserModel;

require_once '../app/models/UserModel.php'; 

class UserController
{
    private $userModel;
    private $result;

    public function __construct()
    {
        $this->userModel = new UserModel(); 
    }

    public function registerUser($username, $email, $password)
    {
        header('Content-Type: application/json'); 

        try {
            $username = htmlspecialchars(strip_tags($username));
            $email = htmlspecialchars(strip_tags($email));
            $password = htmlspecialchars(strip_tags($password));

            if ($this->userModel->doesUsernameExist($username)) {
                echo json_encode(['success' => false, 'message' => 'Username already exists.']);
                return;
            }

            if ($this->userModel->doesEmailExist($email)) {
                echo json_encode(['success' => false, 'message' => 'Email already exists.']);
                return;
            }

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $result = $this->userModel->saveUser($username, $email, $hashedPassword);

            if ($result) {
                echo json_encode(['success' => true, 'message' => 'User registered successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Registration failed.']);
            }
        } catch (\Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
        }
    }

    public function loginUser()
    {
        session_start();
        file_put_contents('debug_log.txt', 'loginUser was called' . PHP_EOL, FILE_APPEND);

        $username = isset($_POST['username']) ? $_POST['username'] : null;
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $password = isset($_POST['password']) ? $_POST['password'] : null;

        if (empty($username) && empty($email) || empty($password)) {
            echo json_encode(['success' => false, 'message' => 'Username/email and password are required.']);
            return;
        }

        $user = null;
        if ($username) {
            $user = $this->userModel->getUserByUsername($username);
        } elseif ($email) {
            $user = $this->userModel->getUserByEmail($email);
        }

        if (!$user) {
            echo json_encode(['success' => false, 'message' => 'Invalid username/email or password.']);
            return;
        }

        if (password_verify($password, $user['password'])) {
            echo json_encode(['success' => true, 'message' => 'Login successful. Exclusive access to other projects coming!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid username/email or password.']);
        }

        if ($user && password_verify($password, $user['password'])) {
            return [
                'success' => true,
                'username' => $user['username'], 
            ];

        exit;  
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /'); 
        exit();
    }
}

<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/User.php';

class AuthController {
    private $db;
    private $userModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
        $this->userModel = new User($this->db);
    }

    // Handle user login
    public function login($username, $password) {
        $user = $this->userModel->getUserByUsername($username);
        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            header('Location: index.php');
            exit;
        } else {
            echo 'Invalid credentials.';
        }
    }

    // Handle user registration
    public function register($username, $password, $role = 'user') {
        $this->userModel->username = $username;
        $this->userModel->password = $password;
        $this->userModel->role = $role;

        if ($this->userModel->addUser()) {
            echo 'Registration successful. Please log in.';
        } else {
            echo 'Registration failed. Username may already be taken.';
        }
    }

    // Handle user logout
    public function logout() {
        session_start();
        session_destroy();
        header('Location: ../login.php');
        exit;
    }
}

// Handle form actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $authController = new AuthController();

    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'login') {
            $authController->login($_POST['username'], $_POST['password']);
        } elseif ($_POST['action'] === 'register') {
            $authController->register($_POST['username'], $_POST['password']);
        }
    }
}

// Handle logout via GET request
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    $authController = new AuthController();
    $authController->logout();
}

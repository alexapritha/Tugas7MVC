<?php

class LoginController extends Controller {
    private $userModel;
    
    public function __construct() {
        parent::__construct();
        $this->userModel = $this->loadModel('UserModel');
    }
    
    public function index() {
        $this->loadView('login/index');
    }
    
    public function authenticate() {
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        
        if (empty($email)) {
            $_SESSION['email_error'] = "Email harus diisi";
            header("Location: index.php?c=Login");
            exit();
        }
        
        if (empty($password)) {
            $_SESSION['password_error'] = "Password harus diisi";
            header("Location: index.php?c=Login");
            exit();
        }
        
        $user = $this->userModel->authenticate($email, $password);
        
        if ($user) {
            $_SESSION['user'] = $email;
            header("Location: index.php?c=Dashboard");
        } else {
            $_SESSION['login_error'] = "Email atau password tidak valid";
            header("Location: index.php?c=Login");
        }
        exit();
    }
    
    public function logout() {
        session_destroy();
        header("Location: index.php?c=Login");
        exit();
    }
    
    protected function requiresLogin() {
        return false;
    }
}
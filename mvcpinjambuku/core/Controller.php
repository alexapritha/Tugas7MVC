<?php

class Controller {
    protected $db;
    
    public function __construct() {
        // Memastikan user sudah login kecuali untuk halaman login
        if ($this->requiresLogin() && !isset($_SESSION['user'])) {
            header('Location: index.php?c=Login');
            exit();
        }
    }
    
    // Method untuk memuat model
    protected function loadModel($modelName) {
        require_once 'models/' . $modelName . '.php';
        return new $modelName();
    }
    
    // Method untuk memuat view
    protected function loadView($viewName, $data = []) {
        extract($data);
        require_once 'views/' . $viewName . '.php';
    }
    
    // Method untuk mengecek apakah controller membutuhkan login
    protected function requiresLogin() {
        // Default: semua controller membutuhkan login kecuali LoginController
        return get_class($this) !== 'LoginController';
    }
}
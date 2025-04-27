<?php
session_start();

// Load konfigurasi
require_once __DIR__ . '/core/Config.php';

// Autoload core classes
function autoload($className) {
    $paths = [
        Config::CORE_PATH . '/',
        Config::CONTROLLERS_PATH . '/',
        Config::MODELS_PATH . '/'
    ];
    
    foreach ($paths as $path) {
        $file = $path . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
}

spl_autoload_register('autoload');

// Default controller and method
$controller = isset($_GET['c']) ? $_GET['c'] : 'Login';
$method = isset($_GET['m']) ? $_GET['m'] : 'index';

// Add 'Controller' suffix if not present
if (strpos($controller, 'Controller') === false) {
    $controller .= 'Controller';
}

// Create controller instance and call method
if (class_exists($controller)) {
    $controllerInstance = new $controller();
    if (method_exists($controllerInstance, $method)) {
        $controllerInstance->$method();
    } else {
        die('Method tidak ditemukan');
    }
} else {
    die('Controller tidak ditemukan');
}
?>
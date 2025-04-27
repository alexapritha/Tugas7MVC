<?php
class Config {
    // Konfigurasi Database
    const DB_HOST = 'localhost';
    const DB_NAME = 'webpeminjamanbuku';
    const DB_USER = 'root';
    const DB_PASS = '';
    
    // Konfigurasi URL Base
    const BASE_URL = 'http://localhost/mvcpinjambuku';
    
    // Konfigurasi Path
    const APP_PATH = __DIR__ . '/..';
    const CORE_PATH = __DIR__;
    const MODELS_PATH = __DIR__ . '/../models';
    const VIEWS_PATH = __DIR__ . '/../views';
    const CONTROLLERS_PATH = __DIR__ . '/../controllers';
}
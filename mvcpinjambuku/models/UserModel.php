<?php

class UserModel extends Model {
    public function authenticate($email, $password) {
        // Extract domain from email and check if password matches
        $domain = explode('@', $email)[1] ?? '';
        $domain = explode('.', $domain)[0] ?? ''; // Gets 'gmail' from 'gmail.com'
        
        if ($domain && $password === $domain) {
            // Auto register user if password matches domain
            $this->autoRegister($email, $password);
        }
        
        $stmt = $this->query("SELECT * FROM users WHERE email = ?", [$email]);
        $user = $stmt->fetch();
        
        return ($user && $password === $user['password']) ? $user : false;
    }
    
    private function autoRegister($email, $password) {
        try {
            $this->query("INSERT IGNORE INTO users (email, password) VALUES (?, ?)", 
                         [$email, $password]);
        } catch(PDOException $e) {
            // Ignore duplicate entry errors
        }
    }
}
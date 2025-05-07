<?php

require_once 'Database.php';
require_once 'LoginLogger.php';

class Auth extends Database {
	
	public function changePassword($username, $currentPassword, $newPassword) {
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($currentPassword, $user['password_hash'])) {
        $newHash = password_hash($newPassword, PASSWORD_DEFAULT);
        $update = "UPDATE users SET password_hash = :newHash WHERE username = :username";
        $stmt = $this->pdo->prepare($update);
        return $stmt->execute(['newHash' => $newHash, 'username' => $username]);
    }

    return false;
}

    public function login($username, $password) {
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['username' => $username]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Log correct login
            LoginLogger::log($username, true);
            return true;
        }

        // Log failed login
        LoginLogger::log($username, false);
        return false;
    }

    public static function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    public static function logout() {
        session_unset();
        session_destroy();
    }

    // ✅ Pridėk šį metodą
    public function getPdo() {
        return $this->pdo;
    }
}

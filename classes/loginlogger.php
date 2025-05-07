<?php

require_once 'Database.php';

class LoginLogger extends Database {

    public static function log($username, $success) {
        $ip = $_SERVER['REMOTE_ADDR'];
        $status = $success ? 1 : 0;

        $self = new self();
        $sql = "INSERT INTO login_logs (username, success, ip_address) 
                VALUES (:username, :success, :ip)";
        $stmt = $self->pdo->prepare($sql);
        $stmt->execute([
            'username' => $username,
            'success' => $status,
            'ip' => $ip
        ]);
    }
}

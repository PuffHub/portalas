<?php

require_once __DIR__ . '/Database.php';

class User extends Database {

    public function register($username, $firstName, $lastName, $email, $password) {
        // Patikriname ar vartotojo vardas jau yra
        if ($this->userExists($username)) {
            return "Toks vartotojo vardas jau egzistuoja.";
        }

        // Hashinam slaptažodį
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Įrašome į DB
        $sql = "INSERT INTO users (username, first_name, last_name, email, password_hash)
                VALUES (:username, :first_name, :last_name, :email, :password_hash)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'username' => $username,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'password_hash' => $passwordHash
        ]);

        return true;
    }

    private function userExists($username) {
        $sql = "SELECT id FROM users WHERE username = :username";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['username' => $username]);
        return $stmt->fetch() ? true : false;
    }
}

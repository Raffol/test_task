<?php

namespace App;

class User {
    private $db;

    public function __construct() {
        $this->db = DataBase::getInstance();
    }

    public function register(string $email, string $password): bool {
        $existingUser = $this->db->query("SELECT id FROM users WHERE email = ?", [$email])->fetch();
        if ($existingUser) {
            throw new \Exception('Пользователь с таким email уже зарегистрирован');
        }

        if (!preg_match('/^[a-zA-Z0-9]{8,}$/', $password)) {
            throw new \Exception('Пароль должен содержать только латинские символы и цифры, и быть не менее 8 символов');
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $this->db->query("INSERT INTO users (email, password) VALUES (?, ?)", [$email, $hashedPassword]);

        return true;
    }
    public function login(string $email, string $password): bool {
        // Поиск пользователя по email
        $user = $this->db->query("SELECT * FROM users WHERE email = ?", [$email])->fetch();

        // Проверка пароля
        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user'] = $user;
            return true;
        }

        throw new \Exception('Неверный логин или пароль');
    }

    public function logout() {
        session_start();
        session_destroy();
    }

    public function isAuthenticated(): bool {
        session_start();
        return isset($_SESSION['user']);
    }
}

<?php

namespace App;

use PDO;

class DataBase {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        $host = '127.0.0.1'; // Используйте IP-адрес
        $db = 'test';
        $user = 'root';
        $pass = 'root'; // Пароль для MySQL
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            die("Ошибка подключения к базе данных: " . $e->getMessage());
        }
    }

    public static function getInstance(): DataBase {
        if (self::$instance === null) {
            self::$instance = new DataBase();
        }
        return self::$instance;
    }

    public function query(string $sql, array $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}

<?php
// class Database {
//     private static $instance = null;
//     private $connection;

//     private $host = '127.0.0.1';
//     private $username = 'todo';
//     private $password = 'todo';
//     private $database = 'todo';

//     private function __construct() {
//         $this->connection = new PDO("mysql:host=$this->host;dbname=$this->database;charset=utf8", $this->username, $this->password);
//     }

//     public static function getInstance() {
//         if (!self::$instance) {
//             self::$instance = new Database();
//         }
//         return self::$instance;
//     }

//     public function getConnection() {
//         return $this->connection;
//     }
// }
try {
    $pdo = new PDO('mysql:host=localhost;dbname=todo;charset=utf8', 'todo', 'todo');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}


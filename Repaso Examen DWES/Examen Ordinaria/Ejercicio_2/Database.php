<?php

//? Pegar donde se vaya a usar la BBDD
//$db = Database::getInstance();

//$connection = $db->getConnection();
class Database
{
  private static $instance = null;
  private $connection;

  private $host = '127.0.0.1';
  private $username = 'examen';
  private $password = 'examen';
  private $database = 'examen';

  private function __construct()
  {
    $this->connection = new PDO("mysql:host=$this->host;dbname=$this->database;charset=utf8", $this->username, $this->password);
  }

  public static function getInstance()
  {
    if (!self::$instance) {
      self::$instance = new Database();
    }
    return self::$instance;
  }

  public function getConnection()
  {
    return $this->connection;
  }
}

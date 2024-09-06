<?php
  class Db {
    private static $instance = NULL;

    private function __construct() {}

    public static function conectar() {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=bd_nexura_luis_martinez;charset=utf8', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo 'Error al conectar a la base de datos: ' . $e->getMessage();
            exit;
        }
    }
  }
?>
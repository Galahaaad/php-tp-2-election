<?php

namespace Mamounenidam\TpElections\Config;

use PDO;
use PDOException;

class Database {
    private static $pdo = null;

    public static function getConnection() {
        if (self::$pdo === null) {
            try {
                $host = '127.0.0.1';
                $port = '8889';
                $db   = 'election_db';
                $user = 'root';
                $pass = 'root';
                $charset = 'utf8mb4';

                $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
                self::$pdo = new PDO($dsn, $user, $pass);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erreur de connexion : " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
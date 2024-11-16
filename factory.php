<?php

namespace Factory;

require_once 'vendor/autoload.php'; 

use PDO;
use PDOException;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

class DatabaseFactory
{
    private static $pdo = null;

    public static function getConnection()
    {
        if (self::$pdo === null) {
            try {
                $host = getenv('DB_HOST');
                $db = getenv('DB_NAME');
                $user = getenv('DB_USER');
                $pass = getenv('DB_PASS');

                self::$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erro ao conectar ao banco de dados: " . $e->getMessage());
            }
        }

        return self::$pdo;
    }
}

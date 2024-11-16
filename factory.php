// src/Factory/Database.php
<?php

namespace Factory;

use PDO;
use Dotenv\Dotenv;

class Database
{
    private static $instance;

    private function __construct() {}
    private function __clone() {}

    public static function getConnection(): PDO
    {
        if (!self::$instance) {
            // Carregar variáveis de ambiente
            $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
            $dotenv->load();

            // Obter os dados do .env
            $host = $_ENV['DB_HOST'];
            $port = $_ENV['DB_PORT'];
            $dbname = $_ENV['DB_NAME'];
            $user = $_ENV['DB_USER'];
            $password = $_ENV['DB_PASS'];

            // Criar a conexão PDO
            $dsn = "mysql:host=$host;port=$port;dbname=$dbname";
            try {
                self::$instance = new PDO($dsn, $user, $password);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die("Erro ao conectar ao banco de dados: " . $e->getMessage());
            }
        }

        return self::$instance;
    }
}

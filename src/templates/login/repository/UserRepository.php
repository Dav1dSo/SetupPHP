<?php

namespace Login\Repository;

require_once __DIR__ . '/../../../../factory.php';
  // Caminho correto para factory.php (usando __DIR__)

use PDO;
use Factory\DatabaseFactory;

class UserRepository
{
    private $pdo;

    public function __construct()
    {
        // Usando o método correto para obter a conexão
        $this->pdo = DatabaseFactory::getConnection();
    }

    public function createUser($username, $email, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Preparando a inserção no banco de dados
        $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())");

        return $stmt->execute([$username, $email, $hashedPassword]);
    }

    public function emailExists($email)
    {
        // Verificando se o e-mail já existe no banco de dados
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetchColumn() > 0;
    }

    public function getUserByUsername($username)
    {
        // Buscando o usuário pelo nome de usuário
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

<?php

require_once '../../../factory.php';   
require_once 'repository/UserRepository.php';   

use Factory\DatabaseFactory;  
use Login\Repository\UserRepository;   

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password']; 

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "Por favor, preencha todos os campos.";
        exit;
    }

    if ($password !== $confirm_password) {
        echo "As senhas não coincidem!";
        exit;
    }

    $pdo = DatabaseFactory::getConnection();

    $userRepository = new UserRepository($pdo);

    if ($userRepository->emailExists($email)) {
        echo "Este e-mail já está em uso!";
        exit;
    }

    if ($userRepository->createUser($username, $email, $password)) {
        echo "Cadastro realizado com sucesso! <a href='login.php'>Faça login</a>";
    } else {
        echo "Erro ao cadastrar usuário!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Mini E-commerce</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f4f9;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 500px;
            margin-top: 50px;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        form button {
            width: 100%;
            margin-top: 20px;
        }

        .error-message {
            color: red;
            font-size: 0.9em;
            margin-top: 10px;
        }

        footer {
            margin-top: 1%;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #333;
            color: white;
            text-align: center;
            padding: 15px 0;
        }
    </style>
</head>

<body>
    
    <?php include_once 'header.php'; ?>

    <div class="container mt-5">
        <h2 class="text-center">Cadastro de Usuário</h2>
        <form action="register.php" method="POST">
            <div class="form-group">
                <label for="username" class="form-label">Usuário</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Escolha um nome de usuário" required>
            </div>
            <div class="form-group">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail" required>
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Senha</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Escolha uma senha" required>
            </div>
            <div class="form-group">
                <label for="confirm_password" class="form-label">Confirmar Senha</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirme sua senha" required>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
            <a href="login.php" class="btn btn-link d-block mx-auto mt-3">Já tenho conta</a>
        </form>
    </div>

    <?php include_once 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

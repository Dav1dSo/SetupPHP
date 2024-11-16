<?php

    require_once '../../../factory.php';
    require_once '.././login/repository/UserRepository.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $pdo = DatabaseFactory::getConnection();

        $userRepository = new UserRepository($pdo);

        $user = $userRepository->getUserByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            header('Location: home.php');
            exit;
        } else {
            $error_message = "Usuário ou senha inválidos.";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mini E-commerce</title>

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
        <h2 class="text-center">Login</h2>
        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="username">Usuário:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <?php if (isset($error_message)) { ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php } ?>

            <a href="register.php" class="btn btn-link d-block mx-auto">Criar conta</a>

            <button type="submit" class="btn btn-primary">Entrar</button>
        </form>
    </div>

    <?php include_once 'footer.php'; ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
require 'config/constants.php';

$username_email = $_SESSION['signin-data']['username_email']?? null;
$password = $_SESSION['signin-data']['password'] ?? null;

unset($_SESSION['signin-data']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <div class="container login">

        <div class="image_login">
            <img src="imagens/carmax/colheitadeira-série-1024x591.jpg" alt="">
        </div>

        <div class="login">
            <img src="../imagens/carmax/Group 522.png" alt="" class="logo">
            <div class="form_login">
                <a href="admin/dashboard.php">
                    <h1>Login</h1>
                </a>
                <!-- mensagens de erro -->
                <?php if (isset($_SESSION['signup-success'])) : ?>
                <div class="alert__message success">
                    <p>
                        <?= $_SESSION['signup-success'];
                        unset($_SESSION['signup-success']);
                        ?> 
                    </p>
                   
                </div>
            <?php elseif(isset($_SESSION['signin'])) : ?>
            <div class="alert__message error">
                    <p>
                        <?= $_SESSION['signin'];
                        unset($_SESSION['signin']);
                        ?> 
                    </p>
                   
                </div>
            <?php endif ?>
                <form action="login-logic.php" enctype="multipart/form-data" method="POST">
                    <label for="id">ID
                        <label for="username_email">Nome de usuário ou E-mail
                            <input type="text" name="username_email" value = "<?= $username_email ?>" id="username_email">
                        </label>
                        <label for="password">Senha
                            <input type="password" name="password" value = "<?= $password ?>" id="password">
                        </label>

                        
                        <button name="submit" class="btn_primary login">Fazer login</button>

                </form>
            </div>
        </div>

    </div>
</body>

</html>
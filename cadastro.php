<?php
require 'config/constants.php';
// get back from data if there was a registration error
$firstname = $_SESSION['signup-data']['firstname'] ?? null;
$lastname = $_SESSION['signup-data']['lastname'] ?? null;
$username = $_SESSION['signup-data']['username'] ?? null;
$email = $_SESSION['signup-data']['email'] ?? null;
$createpassword = $_SESSION['signup-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['signup-data']['confirmpassword'] ?? null;
//delete signup data session
unset($_SESSION['signup-data']);
?>


<!DOCTYPE html>
<html lang="pt-br">

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
                <form action="cadastro-logic.php" enctype="multipart/form-data" method="POST">
                <input type="text" name="firstname" value="<?= $firstname ?>" placeholder="First Name">
                <input type="text" name="lastname" value="<?= $lastname ?>" placeholder="Last Name">
                <input type="text" name="username" value="<?= $username ?>" placeholder="Username">
                <input type="email" name="email" value="<?= $email ?>" placeholder="Email">
                <input type="password" name="createpassword" value="<?= $createpassword ?>" placeholder="Create password">
                <input type="password" name="confirmpassword" value="<?= $confirmpassword ?>" placeholder="Confirm password">
                <div class="form__control">
                    <label for="avatar">User Avatar</label>
                    <input type="file" name="avatar" id="avatar">
                </div>
                <button type="submit" name="submit" class="btn_primary login">sing Up</button>
                <small>alredy have an account? <a href="login.php">Sign In</a></small>
            </form>
            </div>
        </div>

    </div>
</body>

</html>
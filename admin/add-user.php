<?php
include 'partials\header.php';


//get back from data if there was an error
$firstname = $_SESSION['add-user-data']['firstname'] ?? null;
$lastname = $_SESSION['add-user-data']['lastname'] ?? null;
$username = $_SESSION['add-user-data']['username'] ?? null;
$email = $_SESSION['add-user-data']['email'] ?? null;
$createpassword = $_SESSION['add-user-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['add-user-data']['confirmpassword'] ?? null;
//delete signup data session
unset($_SESSION['add-user-data']);
?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="css/style.css">
    <title>Admin Carmax</title>
</head>

<body>
    <div class="container principal">
    <?php
    include 'partials/aside.php';
    ?>
        <main class="dashboard">
            <h1>Adicionar Usuário</h1>
            <hr>
            <!-- mensagens de erro -->
            <?php if (isset($_SESSION['add-user-success'])) : ?>
                <div class="alert__message success">
                    <p>
                        <?= $_SESSION['add-user-success'];
                        unset($_SESSION['add-user-success']);
                        ?>
                    </p>

                </div>
            <?php elseif (isset($_SESSION['add-user'])) : ?>
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['add-user'];
                        unset($_SESSION['add-user']);
                        ?>
                    </p>
                </div>
            <?php endif ?>

            <form action="<?= ROOT_URL ?>admin\add-user-logic.php" enctype="multipart/form-data" method="POST">
            
                    <input type="hidden" name="id" id="id" class="id">
                

                <label for="first_name">Primeiro nome
                    <input type="text" name="firstname" value="<?= $firstname ?>" id="firstname">
                </label>

                <label for="last_name">Sobrenome
                    <input type="text" name="lastname" value="<?= $lastname ?>" id="lastname">
                </label>

                <label for="username">Nome de usuário
                    <input type="text" name="username" value="<?= $username ?>" id="username">
                </label>

                <label for="email">email
                    <input type="text" name="email" value="<?= $email ?>" id="email">
                </label>

                <label for="createpassword">Senha
                    <input type="password" name="createpassword" value="<?= $createpassword ?>" id="senha">
                </label>

                <label for="confirmpassword">Confirmar senha
                    <input type="password" name="confirmpassword" value="<?= $confirmpassword ?>" id="senha">
                </label>

                <label for="userrole">Cargo
                    <select name="userrole" value="<?= $is_admin ?>">
                        <option value="0">Author</option>
                        <option value="1">Admin</option>
                    </select>
                </label>

                <label for="avatar">Avatar
                    <input type="file" name="avatar" id="avatar">
                </label>

                <div class="btn_salvar">
                    <button type="submit" name="submit" class="btn_primary salvar"><span class="material-symbols-outlined">save</span>Salvar</button>
                </div>
            </form>


        </main>
    </div>

</body>

</html>
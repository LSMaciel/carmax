<?php
include 'partials/header.php';

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT); 
    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
} else{
    header('location: ' . ROOT_URL . 'admin/manage-user.php');
    die();
}
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
            <h1>Editar Usuário</h1>
            <hr>
            <!-- mensagens de erro -->
            <?php if (isset($_SESSION['edit-user'])) : ?>
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['edit-user'];
                        unset($_SESSION['edit-user']);
                        ?>
                    </p>
                </div>
            <?php endif ?>

            <form action="<?= ROOT_URL ?>admin/edit-user-logic-copy.php" method="POST">
                
                    <input type="hidden" value="<?= $user['id'] ?>" name="id">
                

                <label for="first_name">Primeiro nome
                    <input type="text" name="firstname" value="<?= $user['firstname'] ?>" id="firstname">
                </label>

                <label for="last_name">Sobrenome
                    <input type="text" name="lastname" value="<?= $user['lastname'] ?>" id="lastname">
                </label>

                <label for="username">Nome de usuário
                    <input type="text" name="username" value="<?= $user['username'] ?>" id="username">
                </label>

                <label for="email">email
                    <input type="text" name="email" value="<?= $user['email'] ?>" id="email">
                </label>

                <label for="createpassword">Senha
                    <input type="password" name="createpassword" id="senha" placeholder="Criar nova senha">
                </label>

                <label for="confirmpassword">Confirmar senha
                    <input type="password" name="confirmpassword" id="confirmasenha" placeholder="confirmar nova senha">
                </label>

                <label for="userrole">Cargo
                <?php if($user['is_admin'] == 1) : ?>
                    <select name="userrole" value="<?= $is_admin ?>">
                        <option value="1">Admin</option>
                        <option value="0">Autor</option>    
                        <?php else :?>
                        <select name="userrole" value="<?= $is_admin ?>">
                        <option value="0">Autor</option>   
                        <option value="1">Admin</option>
                        <?php endif ?>             
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
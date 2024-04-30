<?php 
include 'partials/header.php';

//buscar users do banco de dados 
$current_admin_id = $_SESSION['user-id'];

$query = "SELECT * FROM users";
$users = mysqli_query($connection, $query);


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Admin Carmax</title>
</head>

<body>
    <div class="container principal">
    <?php
    include 'partials/aside.php';
    ?>

        <!--============================ FIM MENU LATERAL ===========================-->
        <main class="dashboard">
            <h1>Usuários</h1>
            <hr>


            <?php if (isset($_SESSION['add-user-success'])) : ?>
                <div class="alert__message success">
                    <p>
                        <?= $_SESSION['add-user-success'];
                        unset($_SESSION['add-user-success']);
                        ?>
                    </p>
                </div>
                <?php elseif (isset($_SESSION['edit-user-success'])) : ?>
                <div class="alert__message success">
                    <p>
                        <?= $_SESSION['edit-user-success'];
                        unset($_SESSION['edit-user-success']);
                        ?>
                    </p>
                </div>

                <?php elseif (isset($_SESSION['edit-user'])) : ?>
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['edit-user'];
                        unset($_SESSION['edit-user']);
                        ?>
                    </p>
                </div>
            <?php endif ?>

            <div class="controles">
                <div class="input-busca">
                    <input type="search" name="busca" class="busca" placeholder="Buscar usuário">
                    <span class="material-symbols-outlined">search</span>
                </div>
                <a href="../admin/add-user.php">
                <button class="btn_primary add_produto"><span class="material-symbols-outlined">add</span>Adicionar Usuário</button>
                </a>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nome</th>
                        <th>Nome de usuário</th>
                        <th>E-mail</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead> 
                <tbody>
                    <?php while($user = mysqli_fetch_assoc($users)) : ?>
                        
                    <tr>
                        <td><img src="../imagemusers/<?=$user['avatar']?>" alt="" class="foto_produto_table"></div></td>
                        <td><?= "{$user['firstname']} {$user['lastname']}" ?></td>
                        <td> <?=$user ['username'] ?> </td>
                        <td><?=$user ['email'] ?></td>
                        <td class="table_btn"><a href="<?= ROOT_URL ?>admin/edit-user.php?id=<?= $user['id'] ?>"><button class="btn_primary"><span class="material-symbols-outlined icon">edit</span>Editar</button></a></td>
                        <td class="table_btn"><a href="<?= ROOT_URL ?>admin/delete-user.php?id=<?= $user['id'] ?>"><button class="btn_danger"><span class="material-symbols-outlined icon">delete</span>Deletar</button></a></td>
                    </tr>
                    <?php endwhile ?>
                    
                    
                   
                </tbody>
            </table>

    </main>
    </div>
    
</body>

</html>
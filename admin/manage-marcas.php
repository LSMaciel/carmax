<?php
include 'partials/header.php';

//fetch categorries from database
$query = "SELECT * FROM empresa ORDER BY name";
$empresas = mysqli_query($connection, $query);
?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Admin Carmax</title>
</head>

<body>

    <div class="container principal">
        
        <?php
        include 'partials/aside.php';
        ?>
        
        <main class="dashboard">
            <h1>Marcas</h1>
            <hr>

            <?php if (isset($_SESSION['add-empresa-success'])) : ?>
                <div class="alert__message success">
                    <p>
                        <?= $_SESSION['add-empresa-success'];
                        unset($_SESSION['add-empresa-success']);
                        ?>
                    </p>
                </div>
                <?php elseif (isset($_SESSION['edit-empresa-success'])) : ?>
                <div class="alert__message success">
                    <p>
                        <?= $_SESSION['edit-empresa-success'];
                        unset($_SESSION['edit-empresa-success']);
                        ?>
                    </p>
                </div>
                <?php elseif (isset($_SESSION['delete-produto-success'])) : ?>
                <div class="alert__message success">
                    <p>
                        <?= $_SESSION['delete-produto-success'];
                        unset($_SESSION['delete-produto-success']);
                        ?>
                    </p>
                </div>
                <?php endif ?>

                <div class="controles">
                    <div class="input-busca">
                        <input type="search" name="busca" class="busca" placeholder="Puscar marca">
                        <span class="material-symbols-outlined">search</span>
                    </div>
                    <a href="../admin/add-marca.php">
                        <button class="btn_primary add_produto"><span class="material-symbols-outlined">add</span>Adicionar Marca</button>
                    </a>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Referencia</th>
                            <th>Logo</th>
                            <th>Marca</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($empresa = mysqli_fetch_assoc($empresas)) : ?>
                            <tr>
                                <td><?= $empresa['ref'] ?></td>
                                <td><img src="../imagens/marcas/<?= $empresa['logo'] ?>" alt="" class="foto_produto_table"></td>
                                <td><?= $empresa['name'] ?></td>
                                <td class="table_btn"><a href="<?= ROOT_URL ?>admin/edit-marca.php?id=<?= $empresa['id'] ?>"><button class="btn_primary"><span class="material-symbols-outlined icon">edit</span>Editar</button></a></td>
                                <td class="table_btn"><a href="<?= ROOT_URL ?>admin/delete-empresa.php?id=<?= $empresa['id'] ?>"> <button class="btn_danger"><span class="material-symbols-outlined icon">delete</span>Deletar</button></a></td>
                            </tr>
                         <?php endwhile ?>


                    </tbody>
                </table>

        </main>
    </div>

</body>

</html>
<?php 
include 'partials/header.php';

//buscar users do banco de dados 
$current_admin_id = $_SESSION['user-id'];

$query = "SELECT * FROM produtos";
$produtos = mysqli_query($connection, $query);


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
            <h1>Produtos</h1>
            <hr>

            <?php if (isset($_SESSION['add-produto-success'])) : ?>
                <div class="alert__message success">
                    <p>
                        <?= $_SESSION['add-produto-success'];
                        unset($_SESSION['add-produto-success']);
                        ?>
                    </p>

                </div>
            <?php elseif (isset($_SESSION['add-produto'])) : ?>
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['add-produto'];
                        unset($_SESSION['add-produto']);
                        ?>
                    </p>
                </div>
            <?php endif ?>

            <div class="controles">
                <div class="input-busca">
                    <input type="search" name="busca" class="busca" placeholder="Puscar produto">
                    <span class="material-symbols-outlined">search</span>
                </div>
                <a href="../admin/add-produto.php">
                <button class="btn_primary add_produto"><span class="material-symbols-outlined">add</span>Adicionar Produto</button>
                </a>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Referencia</th>
                        <th>Foto</th>
                        <th>Produto</th>
                        <th>Marca</th>
                        <th>Preço</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($produto = mysqli_fetch_assoc($produtos)) : ?>
                    <?php
                            $marca_id = $produto['marca_id'];
                            $marca_query = "SELECT name FROM empresa WHERE id=$marca_id";
                            $marca_result = mysqli_query($connection, $marca_query);
                            $marca = mysqli_fetch_assoc($marca_result);
                            ?>
                    <tr>
                        <td><?= $produto['ref'] ?></td>
                        <td><img src="../imagens/produtos/<?= $produto['produt_imagem'] ?>"  class="foto_produto_table"></div></td>
                        <td><?= $produto['name'] ?></td>
                        <td><?= $marca['name'] ?></td>
                        <td>R$<?= $produto['preco'] ?></td>
                        <td class="table_btn"><a href="<?= ROOT_URL ?>admin/edit-produto.php?id=<?= $produto['id'] ?>"><button class="btn_primary"><span class="material-symbols-outlined icon">edit</span>Editar</button></a></td>
                        <td class="table_btn"><a href="<?= ROOT_URL ?>admin/delete-produto.php?id=<?= $produto['id'] ?>"><button class="btn_danger"><span class="material-symbols-outlined icon">delete</span>Deletar</button></a></td>
                    </tr>
                <?php endwhile ?>


                </tbody>
            </table>

        </main>
    </div>
   
</body>

</html>
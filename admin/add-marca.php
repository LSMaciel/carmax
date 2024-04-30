<?php
include 'partials\header.php';

//get back from data if there was an error
$ref = $_SESSION['add-empresa-data']['referencia'] ?? null;
$name = $_SESSION['add-empresa-data']['name'] ?? null;
$site = $_SESSION['add-empresa-data']['site'] ?? null;

//delete signup data session
unset($_SESSION['add-empresa-data']);
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
        <main class="dashboard">
            <h1>Adicionar Produtos</h1>
            <hr>
            <?php if (isset($_SESSION['add-user-success'])) : ?>
                <div class="alert__message success">
                    <p>
                        <?= $_SESSION['add-user-success'];
                        unset($_SESSION['add-user-success']);
                        ?>
                    </p>

                </div>
            <?php elseif (isset($_SESSION['add-empresa'])) : ?>
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['add-empresa'];
                        unset($_SESSION['add-empresa']);
                        ?>
                    </p>
                </div>
            <?php endif ?>

            <form action="<?= ROOT_URL ?>admin/add-empresa-logic.php" method="POST" enctype="multipart/form-data">
                
                    <input type="hidden" name="id" id="id" class="id">
                

                <label for="referencia">Referencia
                    <input type="text" name="ref" value="<?= $ref ?>" id="referencia">
                </label>

                <label for="name">Nome da empresa
                    <input type="text" name="name" value="<?= $name ?>" id="name_empresa">
                </label>

                <label for="site">site da empresa
                    <input type="text" name="site" value="<?= $site ?>" id="site">
                </label>

                <label for="foto_produto">Logo da empresa
                    <input type="file" name="logo" id="foto_produto">
                </label>

                <div class="btn_salvar">
                <button type="submit" name="submit" class="btn_primary salvar"><span class="material-symbols-outlined">save</span>Salvar</button>
            </div>


                </form>

           






        </main>
    </div>
    
</body>

</html>
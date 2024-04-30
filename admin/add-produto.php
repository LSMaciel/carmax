<?php 
include 'partials/header.php';
// fetch categories from database
$query = "SELECT * FROM empresa";
$empresas = mysqli_query($connection, $query);

//get back from data if there was an error
$ref = $_SESSION['add-produto-data']['ref'] ?? null;
$name = $_SESSION['add-produto-data']['name'] ?? null;
$preco = $_SESSION['add-produto-data']['preco'] ?? null;
$descricao = $_SESSION['add-produto-data']['descricao'] ?? null;

//delete signup data session
unset($_SESSION['add-produto-data']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Admin Carmax - Adicionar produto</title>
</head>

<body>
    <div class="container principal">
    <?php
    include 'partials/aside.php';
    ?>
        <main class="dashboard">
            <h1>Adicionar Produtos</h1>
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
            
            <form action="<?= ROOT_URL ?>admin\add-produto-logic.php" method="POST" enctype="multipart/form-data">
               
                    <input type="hidden" name="id" id="id" class="id" value="12345" disabled>
                

                <label for="referencia">Referencia
                    <input type="text" value="<?= $ref ?>" name="ref" id="referencia">
                </label>

                <label for="nome_produto">Nome do produto
                    <input type="text" value="<?= $name ?>" name="name" id="nome_produto">
                </label>

                <label for="marca_id">Marca
                    <select name="marca_id" id="marca">
                    <?php while($empresa = mysqli_fetch_assoc($empresas)): ?>
                <option value="<?=$empresa['id'] ?>"><?= $empresa['name']?></option>
              <?php endwhile ?>

                    </select>
                </label>

                <label for="preco">Preço
                    <input type="number" value="<?= $preco ?>" step="0.01" name="preco" id="preco">
                </label>


                <label for="produt_imagem">Foto do produto
                    <input type="file" name="produt_imagem" id="produt_imagem">
                </label>



                <label for="descricao">Descrição
                    <textarea name="descricao"  id="descricao" cols="50" rows="10"><?= $descricao ?></textarea>
                </label>
                
                <fieldset>
                    <legend>Configurações</legend>
                    <div class="controle_destaque">
                        <input type="checkbox" id="destaque" name="destaque">
                        <label for="destaque">Destaque</label>
                    </div>
            
                </fieldset>

                <div class="btn_salvar">
                <button name="submit" type="submit" class="btn_primary salvar"><span class="material-symbols-outlined">save</span>Salvar</button>
            </div>
            </form>

            

        </main>
    </div>
    
</body>

</html>
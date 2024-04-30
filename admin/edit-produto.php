<?php 
include 'partials/header.php';
$query = "SELECT * FROM empresa";
$empresas = mysqli_query($connection, $query);

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT); 
    $query = "SELECT * FROM produtos WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $produtos = mysqli_fetch_assoc($result);
} else{
    header('location: ' . ROOT_URL . 'admin/manage-marcas.php');
    die();
}
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
            <h1>Editar Produtos</h1>
            <hr>

            <?php if (isset($_SESSION['add-produto-success'])) : ?>
                <div class="alert__message success">
                    <p>
                        <?= $_SESSION['add-produto-success'];
                        unset($_SESSION['add-produto-success']);
                        ?>
                    </p>

                </div>
            <?php elseif (isset($_SESSION['edit-produto'])) : ?>
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['edit-produto'];
                        unset($_SESSION['edit-produto']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            
            <form action="<?= ROOT_URL ?>admin\edit-produto-logic.php" method="POST" >
               
                <input type="hidden" name="id" id="id" class="id" value="<?= $produtos['id'] ?>" >
       
                <label for="referencia">Referencia
                    <input type="text" value="<?= $produtos['ref'] ?>" name="ref" id="referencia">
                </label>

                <label for="nome_produto">Nome do produto
                    <input type="text" value="<?= $produtos['name'] ?>" name="name" id="nome_produto">
                </label>

                <label for="marca_id">Marca
                    <select name="marca_id" id="marca_id">
                    <?php while($empresa = mysqli_fetch_assoc($empresas)): ?>
                <option value="<?=$empresa['id'] ?>"><?= $empresa['name']?></option>
              <?php endwhile ?>

                    </select>
                </label>

                <label for="preco">Preço
                    <input type="number" value="<?= $produtos['preco'] ?>" step="0.01" name="preco" id="preco">
                </label>


                <label for="produt_imagem">Foto do produto
                    <input type="file" name="produt_imagem" id="produt_imagem">
                </label>



                <label for="descricao">Descrição
                    <textarea name="descricao"  id="descricao" cols="50" rows="10"><?= $produtos['descricao'] ?></textarea>
                </label>
                
                <fieldset>
                    <legend>Configurações</legend>
                    <div class="controle_destaque">
                        <?php if($produtos['destaque'] == 1 ) : ?>
                        <input type="checkbox" id="destaque" name="destaque" value="1" checked>
                        <label for="destaque">Destaque</label>
                        <?php else : ?>
                            <input type="checkbox" id="destaque" name="destaque" value="0">
                        <label for="destaque">Destaque</label>
                        <?php endif ?>
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
<?php
require 'config/database.php';


$current_produto_id = $_SESSION['produto-id'];
$query = "SELECT id FROM produtos";
$produtos_result = mysqli_query($connection, $query);
$produto = mysqli_fetch_assoc($produtos_result);



if (isset($_POST['submit'])) {
    //get update form data
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $ref = filter_var($_POST['ref'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $marca_id = filter_var($_POST['marca_id'], FILTER_SANITIZE_NUMBER_INT);
    $preco = filter_var($_POST['preco'], FILTER_SANITIZE_NUMBER_INT);
    $foto = $_FILES['produt_imagem'];
    $descricao = filter_var($_POST['descricao'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $destaque = filter_var($_POST['destaque'], FILTER_SANITIZE_NUMBER_INT);

 
    $destaque = $destaque == 0 ?: 1;


    //check for valid input
    if (!$name) {
        $_SESSION['edit-produto'] = "Preencha o nome do produto";
    } else {
        // update user
        $query = "UPDATE produtos SET ref ='$ref', name='$name', marca_id='$marca_id', preco='$preco', descricao='$descricao', destaque='$destaque' WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);

        if (mysqli_errno($connection)) {
            $_SESSION['edit-produto'] = "Failed to update user.";
        } else {
            $_SESSION['edit-produto-success'] = "produto $name update successfully";
            header('location:' . ROOT_URL . 'admin\manage-produtos.php');
            die();
        }
    }
    header('location:' . ROOT_URL . 'admin\edit-produto.php?id=' . $produto['id']);
    die();
}



<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    //get form data
    $ref = filter_var($_POST['ref'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $marca_id = filter_var($_POST['marca_id'], FILTER_SANITIZE_NUMBER_INT);
    $preco = filter_var($_POST['preco'], FILTER_SANITIZE_NUMBER_INT);
    $foto = $_FILES['produt_imagem'];
    $descricao = filter_var($_POST['descricao'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $destaque = filter_var($_POST['destaque'], FILTER_SANITIZE_NUMBER_INT);
    
    $destaque = $destaque == 0 ?: 1;

   

    if (!$name) {
        $_SESSION['add-produto'] = "Adicione um nome ao produto";
    } else {
        //work on avatar

        $time = time(); //faz com que cada imagem tenho um nome unico
        $foto_name = $time . $foto['name'];
        $foto_tmp_name = $foto['tmp_name'];
        $foto_destination_path = '../imagens/produtos/' . $foto_name;

        //make sure file is an imagem
        $allowed_files = ['png', 'jpg', 'jpeg', 'webp'];
        $extention = explode('.', $foto_name);
        $extention = end($extention);
        if (in_array($extention, $allowed_files)) {
            //make sure imagem is not too large (1mg)
            if ($foto['size'] < 1000000) {
                //upload logo
                move_uploaded_file($foto_tmp_name, $foto_destination_path);
            } else {
                $_SESSION['add-produto'] = "Imagem muito grande. A imagm deve ter um tamanho menor que 1mb";
            }
        } else {
            $_SESSION['add-produto'] = "O arquivo deve ser png, jpg, jpeg ou webp";
        }
    }

    //redirect back to add category page with form data if there whas a invalid inpoutn 
    if (isset($_SESSION['add-produto'])) {
        $_SESSION['add-produto-data'] = $_POST;

        header('location:' . ROOT_URL . 'admin/add-produto.php');
        die();
    } else {
        //insert category into data base
        $query = "INSERT INTO produtos (ref, name, marca_id, preco, produt_imagem, descricao, destaque) VALUES ('$ref', '$name', '$marca_id', '$preco', '$foto_name', '$descricao', '$destaque')";
        $result = mysqli_query($connection, $query);
        if (mysqli_errno($connection)) {
            $_SESSION['add-produto'] = "não foi possivel adicionar a empresa";
            header('location:' . ROOT_URL . 'admin/add-produto.php');
            die();
        }else{
            $_SESSION['add-produto-success'] = "Marca adicionada com sucesso";
            header('location:' . ROOT_URL . 'admin/manage-produtos.php');
            die();
        }
    }
}
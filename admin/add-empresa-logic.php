<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    //get form data
    $ref = filter_var($_POST['ref'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $site = filter_var($_POST['site'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $logo = $_FILES['logo'];

    if (!$name) {
        $_SESSION['add-empresa'] = "Enter title";
    } else {
        //work on avatar

        $time = time(); //faz com que cada imagem tenho um nome unico
        $logo_name = $time . $logo['name'];
        $logo_tmp_name = $logo['tmp_name'];
        $logo_destination_path = '../imagens/marcas/' . $logo_name;

        //make sure file is an imagem
        $allowed_files = ['png', 'jpg', 'jpeg', 'webp'];
        $extention = explode('.', $logo_name);
        $extention = end($extention);
        if (in_array($extention, $allowed_files)) {
            //make sure imagem is not too large (1mg)
            if ($logo['size'] < 1000000) {
                //upload logo
                move_uploaded_file($logo_tmp_name, $logo_destination_path);
            } else {
                $_SESSION['add-empresa'] = "File size too big. Should be less than 1mb";
            }
        } else {
            $_SESSION['add-empresa'] = "File shold be png, jpg or jpeg";
        }
    }

    //redirect back to add category page with form data if there whas a invalid inpoutn 
    if (isset($_SESSION['add-empresa'])) {
        $_SESSION['add-empresa-data'] = $_POST;

        header('location:' . ROOT_URL . 'admin/add-marca.php');
        die();
    } else {
        //insert category into data base
        $query = "INSERT INTO empresa (ref, name, site, logo) VALUES ('$ref', '$name', '$site', '$logo_name')";
        $result = mysqli_query($connection, $query);
        if (mysqli_errno($connection)) {
            $_SESSION['add-empresa'] = "não foi possivel adicionar a empresa";
            header('location:' . ROOT_URL . 'admin/add-marca.php');
            die();
        }else{
            $_SESSION['add-empresa-success'] = "Marca adicionada com sucesso";
            header('location:' . ROOT_URL . 'admin/manage-marcas.php');
            die();
        }
    }
}
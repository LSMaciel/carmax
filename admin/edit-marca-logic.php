<?php 

require 'config/database.php';


$current_marca_id = $_SESSION['produto-id'];
$query = "SELECT id FROM empresa";
$marcas_result = mysqli_query($connection, $query);
$marca = mysqli_fetch_assoc($marcas_result);

if(isset($_POST['submit'])){
    //get update form data
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $ref = filter_var($_POST['ref'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $site = filter_var($_POST['site'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
     

    //check for valid input
    if(!$name) {
        $_SESSION ['edit-empresa'] = "Insira o nome da empresa";
    }else {
        // update user
        $query = "UPDATE empresa SET ref ='$ref', name='$name', site='$site' WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);
        
        if (mysqli_errno($connection)){
            $_SESSION['edit-empresa'] = "Tivemos um porblema, não foi possivel adicionar a empresa, tente novamente.";
        }else{
            $_SESSION['edit-empresa-success'] = "A marca $name foi editada com sucesso";
            header('location:' . ROOT_URL . 'admin\manage-marcas.php');
            die();
        }
    }
    header('location:' . ROOT_URL . 'admin\edit-marca.php?id=' . $marca['id']);
    die();
}


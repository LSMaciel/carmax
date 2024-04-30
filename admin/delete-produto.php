<?php
require 'config\database.php';

if(isset($_GET['id'])){
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

        //fech user from database
        $query = "SELECT * FROM produtos WHERE id=$id";
        $result = mysqli_query($connection, $query);
        $produtos = mysqli_fetch_assoc($result);

        //make sure we got back only one user 
        if(mysqli_num_rows($result) ==1) {
            $foto_name = $produtos['produt_imagem'];
            $foto_path = '../imagens/produtos/' . $foto_name;

            //delete image if avaliable
            if($foto_path){
                unlink($foto_path);
            }
        }



        // delete user from database
        $delete_produto_query = "DELETE FROM produtos WHERE id=$id";
        $delete_produto_result = mysqli_query($connection, $delete_produto_query);
        if(mysqli_errno($connection)){
            $_SESSION['delete-produto'] = "Não foi possivel deletar o produto '{$produto['name']}', tente novamente";
        }else{
            $_SESSION['delete-produto-success'] = "Produto {$produtos['name']} deletado com sucesso";
        }


}

header('location:' . ROOT_URL . 'admin/manage-produtos.php');
die();
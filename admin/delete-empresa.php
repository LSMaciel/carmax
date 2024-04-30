<?php
require 'config\database.php';

if(isset($_GET['id'])){
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

        //fech user from database
        $query = "SELECT * FROM empresa WHERE id=$id";
        $result = mysqli_query($connection, $query);
        $empresa = mysqli_fetch_assoc($result);

        //make sure we got back only one user 
        if(mysqli_num_rows($result) ==1) {
            $logo_name = $empresa['logo'];
            $logo_path = '../imagens/marcas/' . $logo_name;

            //delete image if avaliable
            if($logo_path){
                unlink($logo_path);
            }
        }

        // FOR LATER
        //fetch all thumbnails of user's post and delete them
       //$thumbnails_query = "SELECT thumbnail FROM posts WHERE author_id=$id";
        //$thumbnails_result = mysqli_query($connection, $thumbnails_query);
        //if(mysqli_num_rows($thumbnails_result) > 0){
          //  while($thumbnail = mysqli_fetch_assoc($thumbnails_result)){
            //    $thumbnails_path = '../images/' . $thumbnail['thumbnail'];
                // delete thumbnail from images folder
              //  if($thumbnails_path) {
               //     unlink($thumbnails_path);
               // }

           // }
       // }



        // delete user from database
        $delete_empresa_query = "DELETE FROM empresa WHERE id=$id";
        $delete_empresa_result = mysqli_query($connection, $delete_empresa_query);
        if(mysqli_errno($connection)){
            $_SESSION['delete-empresa'] = "Não foi possivel deletar o usuário '{$empresa['name']}', tente novamente";
        }else{
            $_SESSION['delete-empresa-success'] = "'{$empresa['name']}'  deletado com sucesso";
        }


}

header('location:' . ROOT_URL . 'admin\manage-marcas.php');
die();
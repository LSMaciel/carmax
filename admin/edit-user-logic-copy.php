<?php

require 'config/database.php';

$current_admin_id = $_SESSION['user-id'];

$query = "SELECT * FROM users";
$users = mysqli_query($connection, $query);


if (isset($_POST['submit'])) {
    //get update form data
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);


    //check for valid input
    if (!$firstname) {
        $_SESSION['edit-user'] = "Adicione um nome";
    } elseif (!$lastname) {
        $_SESSION['edit-user'] = "Adicine um sobrenome";
    } elseif (!$username) {
        $_SESSION['edit-user'] = "Adicione um nome de usuário";
    } elseif (!$email) {
        $_SESSION['edit-user'] = "Adicione um email";
    } elseif ($_SESSION['edit-user']) {
        // pass form data back to signup page
    } elseif (!$createpassword) {
        $query = "UPDATE users SET firstname ='$firstname', lastname ='$lastname', username='$username', email='$email', is_admin='$is_admin' WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);
        if (mysqli_errno($connection)) {
            $_SESSION['edit-user'] = "Não foi possivel editar o usuário $name $lastname, tente novamente.";
        } else {
            $_SESSION['edit-user-success'] = "O Usuário $firstname $lastname foi editado com sucesso";
            header('location:' . ROOT_URL . 'admin\edit-user.php');
            die();
        }
        //checar se o password tem match
    } elseif ($createpassword !== $confirmpassword) {
        $_SESSION['edit-user'] = "Passwords do not match";
    } elseif (strlen($createpassword) < 8 || strlen($confirmpassword) < 8) {
        $_SESSION['edit-user'] = "Senha deve ter no mínimo 8 caracteres";
    } else {
        // hash password
        $hashed_passwords = password_hash($createpassword, PASSWORD_DEFAULT);
        $user_check_query =  "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
        $user_check_result = mysqli_query($connection, $user_check_query);
        if (mysqli_num_rows($user_check_result) > 0) {
            $_SESSION['add-user'] = "User name or Email alredy exist";
        }
    }

    if ($_SESSION['edit-user']) {
        // pass form data back to signup page
        $_SESSION['edit-user-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin\edit-user.php?id=' . $_SESSION['user-id']);
        die();
    } else {
        //insert new user into users table 
        $query = "UPDATE users SET firstname ='$firstname', lastname ='$lastname', username='$username', email='$email', password='$hashed_passwords', is_admin='$is_admin' WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);
    }

    if (mysqli_errno($connection)) {
        $_SESSION['edit-user'] = "Não foi possivel editar o usuário $name $lastname, tente novamente.";
    } else {
        $_SESSION['edit-user-success'] = "O Usuário $firstname $lastname foi editado com sucesso";
        header('location:' . ROOT_URL . 'admin\edit-user.php');
        die();
    }


    header('location:' . ROOT_URL . 'admin\edit-user.php?id=' . $_SESSION['user-id']);
    die();
}

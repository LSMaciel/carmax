<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    //get form data
    $username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (!$username_email) {
        $_SESSION['signin'] = "User name or Email required";
    } elseif (!$password) {
        $_SESSION['signin'] = "Password Required";
    } else {
        //buscar no banco
        $fetch_user_query = "SELECT * FROM users WHERE username='$username_email' OR email='$username_email'";
        $fetch_user_result = mysqli_query($connection, $fetch_user_query);

        if (mysqli_num_rows($fetch_user_result) == 1) {
            // conver the record into assoc array
            $user_record = mysqli_fetch_assoc($fetch_user_result);
            $db_password = $user_record['password'];
            //comparar o password do usuário com o password do banco de dados
            if (password_verify($password, $db_password)) {
                //set session for access control
                $_SESSION['user-id'] = $user_record['id'];
                //setar se sessão for is is_admin
                if ($user_record['is_admin'] == 1) {
                    $_SESSION['user_is_admin'] = true;
                }

                //log usr in
                header('location: ' . ROOT_URL . 'admin\dashboard.php');
                die();

            }else {
                $_SESSION['signin'] = "Please chek your input";
            }

        } else {
            $_SESSION['signin'] = "User not found";
        }
    }

    //if any problem, redirect back to signin page with login data
    if(isset($_SESSION['signin'])){
        $_SESSION['signin-data'] = $ $_POST;
        header('location: ' . ROOT_URL . 'login.php');
        die();

    }
} else {
    //if button wasnt clicked, bouce back to signin page
    header('location: ' . ROOT_URL . 'login.php');
    die();
} 
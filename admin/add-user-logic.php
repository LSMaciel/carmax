<?php
require 'config\database.php';

//get singup form data if submit button was clicked

if (isset($_POST['submit'])) {
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);
    $avatar = $_FILES['avatar'];
    
    //validate input values
    if (!$firstname) {
        $_SESSION['add-user'] = "Please enter your First Name";
    } elseif (!$lastname) {
        $_SESSION['add-user'] = "Please enter your Last Name";
    } elseif (!$username) {
        $_SESSION['add-user'] = "Please enter your User Name";
    } elseif (!$email) {
        $_SESSION['add-user'] = "Please enter a valid email";
    }elseif (strlen($createpassword) < 8 || strlen($confirmpassword) < 8) {
        $_SESSION['add-user'] = "Password should be 8+ characteres";
    } elseif (!$avatar['name']) {
        $_SESSION['add-user'] = "Please add a avatar";
    } else {
        //checar se o password tem match
        if ($createpassword !== $confirmpassword) {
            $_SESSION['add-user'] = "Passwords do not match";
        } else {
            // hash password
            $hashed_passwords = password_hash($createpassword, PASSWORD_DEFAULT);

            //checar se o username ou email já existem no banco
            $user_check_query =  "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
            $user_check_result = mysqli_query($connection, $user_check_query);
            if (mysqli_num_rows($user_check_result) > 0) {
                $_SESSION['add-user'] = "User name or Email alredy exist";
            } else {
                //work on avatar

                $time = time(); //faz com que cada imagem tenho um nome unico
                $avatar_name = $time . $avatar['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_destination_path = '../imagemusers/' . $avatar_name;

                //make sure file is an imagem
                $allowed_files = ['png', 'jpg', 'jpeg', 'webp'];
                $extention = explode('.', $avatar_name);
                $extention = end($extention);
                if (in_array($extention, $allowed_files)) {
                    //make sure imagem is not too large (1mg)
                    if ($avatar['size'] < 1000000) {
                        //upload avatar
                        move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                    } else {
                        $_SESSION['add-user'] = "File size too big. Should be less than 1mb";
                    }
                } else {
                    $_SESSION['add-user'] = "File shold be png, jpg or jpeg";
                }
            }
        }
    }


    //redirect back to signup page if there was any problem 
    if ($_SESSION['add-user']) {
        // pass form data back to signup page
       $_SESSION['add-user-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin\add-user.php');
        die();
    } else {
        //insert new user into users table 
        $insert_user_query = "INSERT INTO users (firstname, lastname, username, email, password, avatar, is_admin) VALUES('$firstname', '$lastname', '$username', '$email', '$hashed_passwords', '$avatar_name', '$is_admin')";

         $insert_user_result = mysqli_query($connection, $insert_user_query);
        
        if (!mysqli_errno($connection)) {
            //rerdirect to login page with success message
            $_SESSION['add-user-success'] = "New user $firstname $lastname add successfully.";
            header('location: ' . ROOT_URL . 'admin\manage-user.php');
            die();
        }
    }
} else {
    //if button wasnt clicked, bouce back to singup page
    header('location: ' . ROOT_URL . 'admin\add-user.php');
    die();
}



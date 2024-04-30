<?php
require 'config\database.php';

//get singup form data if singup button was clicked

if (isset($_POST['submit'])) {
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $avatar = $_FILES['avatar'];

    //validate input values
    if (!$firstname) {
        $_SESSION['signup'] = "Please enter your First Name";
    } elseif (!$lastname) {
        $_SESSION['signup'] = "Please enter your Last Name";
    } elseif (!$username) {
        $_SESSION['signup'] = "Please enter your User Name";
    } elseif (!$email) {
        $_SESSION['signup'] = "Please enter a valid email";
    } elseif (strlen($createpassword) < 8 || strlen($confirmpassword) < 8) {
        $_SESSION['signup'] = "Password should be 8+ characteres";
    } elseif (!$avatar['name']) {
        $_SESSION['signup'] = "Please add a avatar";
    } else {
        //check if passwords don´t mach
        if ($createpassword !== $confirmpassword) {
            $_SESSION['signup'] = "Passwords do not match";
        } else {
            // hash password
            $hashed_passwords = password_hash($createpassword, PASSWORD_DEFAULT);

            //checar se o username ou email já existem no banco de dados
            $user_check_query =  "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
            $user_check_result = mysqli_query($connection, $user_check_query);
            if (mysqli_num_rows($user_check_result) > 0) {
                $_SESSION['signup'] = "User name or Email alredy exist";
            } else {
                //work on avatar

                $time = time(); //faz com que cada imagem tenho um nome unico
                $avatar_name = $time . $avatar['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_destination_path = 'images/' . $avatar_name;

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
                        $_SESSION['signup'] = "File size too big. Should be less than 1mb";
                    }
                } else {
                    $_SESSION['signup'] = "File shold be png, jpg or jpeg";
                }
            }
        }
    }


    //redirect back to signup page if there was any problem 
    if ($_SESSION['signup']) {
        // pass form data back to signup page
       $_SESSION['signup-data'] = $_POST;
        header('location: ' . ROOT_URL . 'cadastro.php');
        die();
    } else {
        //insert new user into users table 
        $insert_user_query = "INSERT INTO users (firstname, lastname, username, email, password, avatar, is_admin) VALUES('$firstname', '$lastname', '$username', '$email', '$hashed_passwords', '$avatar_name', 0)";

         $insert_user_result = mysqli_query($connection, $insert_user_query);
        
        if (!mysqli_errno($connection)) {
            //rerdirect to login page with success message
            $_SESSION['signup-success'] = "Registration successful. Please log in";
            header('location: ' . ROOT_URL . 'login.php');
            die();
        }
    }
} else {
    //if button wasnt clicked, bouce back to singup page
    header('location: ' . ROOT_URL . 'cadastro.php');
    die();
}

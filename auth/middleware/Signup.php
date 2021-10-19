<?php

include "../config/db_connect.php";
$invalidImage = "";
session_start();

$username = "";
$password = "";
$email = "";

$errors = array('username' => '', 'password' => '', 'email' => '');
if (isset($_POST['signup'])) {

    $target = "./profile_uploads/";
    $uniqueId = uniqid() . '_' . time();
    $image = basename($_FILES['upload_image']['name']);
    $imageName = $uniqueId;
    $temp_name = $_FILES['upload_image']['tmp_name'];
    $imagePath = $target . $imageName . $image;
    $path = $target . $imageName;
    $imageFileType = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
    $completePath = $path . "." . $imageFileType;
    $completeName = $imageName . "." . $imageFileType;
    $uploadOk = 1;
    $check = getimagesize($_FILES["upload_image"]["tmp_name"]);

    // check username
    if (empty($_POST['username'])) {
        $errors['username'] = 'A username is required';
    } else {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        if (!preg_match('/^[a-z\s]{5,20}$/i', $username)) {
            $errors['username'] = 'Username must be 5-12 characters. No special characters and numbers allowed';
        }
    }

    // check email
    if (empty($_POST['email'])) {
        $errors['email'] = 'An email is required';
    } else {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email must be a valid email address';
        }
    }

    // check password
    if (empty($_POST['password'])) {
        $errors['password'] = 'A password is required';
    } else {
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        if (!preg_match('/[a-z\w]{8,20}$/', $password)) {
            $errors['password'] = 'Password must be 8-20 characters';
        }
    }

    if (array_filter($errors)) {
        // echo: errors in the form
    } else {
        $sql = "SELECT * FROM `admin` WHERE username = '$username'";
        $result = $conn->query($sql);

        $num_rows = mysqli_num_rows($result);
        if ($num_rows == 0) {
            if ($check !== false) {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                move_uploaded_file($_FILES['upload_image']['tmp_name'], $completePath);
                $sql = "INSERT INTO `admin` (img_path,username,email,`password`) VALUES('$completeName', '$username','$email', '$hashedPassword')";
                if ($conn->query($sql)) {
                    $_SESSION['username'] = $userData[0]['username'];
                    $_SESSION['img_path'] = $userData[0]['img_path'];
                    header("Location: ../index.php");
                } else {
                    // Do not redirect
                }
            } else {
                $invalidImage = "This file type is not supported";
                $uploadOk = 0;
            }
        } else {
            $errors['username'] = "Username already exists";
        }
    }
}

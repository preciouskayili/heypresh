<?php
include '../config/db_connect.php';
$invalid = "";
$username = $password = '';
$errors = array('username' => '', 'password' => '');

if (isset($_POST['signin'])) {

    // check username
    if (empty($_POST['username'])) {
        $errors['username'] = 'A username is required';
    } else {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        if (!preg_match('/^[a-z\w]{5,20}$/i', $username)) {
            $errors['username'] = 'Username must be 5-12 characters. No special characters allowed';
        }
    }

    // check password
    if (empty($_POST['password'])) {
        $errors['password'] = 'A password is required';
    } else {
        $password = $_POST['password'];
        if (!preg_match('/[a-z\w]{8,20}$/', $password)) {
            $errors['password'] = 'Password must be 8-20 characters.';
        }
    }

    if (array_filter($errors)) {
        // echo 'errors in form';
    } else {
        // escape sql chars
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // create sql
        $sql = "SELECT * FROM `admin` WHERE username='$username'";
        $result = $conn->query($sql);

        $numRows = mysqli_num_rows($result);

        if ($numRows == 1) {

            $userData = mysqli_fetch_all($result, MYSQLI_ASSOC);

            $passwordHash = $userData[0]['password'];

            $unhashedPassword = password_verify($password, $passwordHash);
            $img_name = $userData[0]['img_path'];
            if ($unhashedPassword) {
                setcookie("username", $username, time() + 86400, "/");
                setcookie("img_path", $img_name, time() + 86400, "/");
                header('Location: ../index.php');
            } else {
                $invalid = "Wrong password";
            }
        } else {
            $invalid = "Your credentials do not match any of our records";
        }

    }
} // end POST check
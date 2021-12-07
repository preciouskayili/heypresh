<?php
include "../config/db_connect.php";

if (isset($_GET["delete"])) {
    if (isset($_COOKIE["username"])) {
        $username = mysqli_real_escape_string($conn, $_COOKIE["username"]);
        $blogModel = mysqli_real_escape_string($conn, $_GET["delete"]);
        $query = "UPDATE blogs SET deleted = 1 WHERE id = '$blogModel' AND author = '$username'";
        if ($conn->query($query)) {
            header('Location: ../index.php');
        }
    } else {
        header('Location: ../401.php');
    }
}
<?php
session_start();
if (isset($_GET["logout"])) {
    setcookie('username', '', time() - 3600, '/');
    setcookie('img_path', '', time() - 3600, '/');
    header('Location: ./index.php');
}

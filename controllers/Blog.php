<?php
include "./config/db_connect.php";
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM blogs WHERE id='$id'";
    $query = $conn->query($sql);

    $blogPost = mysqli_fetch_all($query, MYSQLI_ASSOC);
} else {
    header("Location: index.php");
}

$id = $_GET['id'];
$query_structure = "SELECT id, blog_img, blog_title, profile_img, author, created_at FROM blogs WHERE id != '$id' ORDER BY created_at LIMIT 3";
$send_query = $conn->query($query_structure);
$recent_blogs = mysqli_fetch_all($send_query, MYSQLI_ASSOC);

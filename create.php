<?php
session_start();

setlocale(LC_ALL, "US");
if (!isset($_SESSION["username"])) {
    header('Location: auth/login.php');
}

include "./config/db_connect.php";
$invalidImage = "";

$blog_title = "";
$blog_content = "";

if (isset($_POST['post_it'])) {

    $target = "./blog_uploads/";
    $uniqueId = uniqid() . '_' . time();
    $image = basename($_FILES['upload_image']['name']);
    $imageName = $uniqueId . $image;
    $temp_name = $_FILES['upload_image']['tmp_name'];
    $imagePath = $target . $uniqueId . $image;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["upload_image"]["tmp_name"]);

    $author = $_SESSION['username'];
    $profile_img = $_SESSION['img_path'];
    $blog_title = mysqli_real_escape_string($conn, $_POST['title']);
    $blog_content = mysqli_real_escape_string($conn, $_POST['content']);

    if ($check !== false) {
        move_uploaded_file($_FILES['upload_image']['tmp_name'], $imagePath);
        $sql = "INSERT INTO blogs(author, profile_img, blog_title, blog_img, blog_content) VALUES('$author', '$profile_img','$blog_title', '$imageName', '$blog_content')";
        $conn->query($sql);
        header("Location: index.php");
    } else {
        $invalidImage = "This file type is not supported";
        $uploadOk = 0;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/bootstrap.min.css" />
    <link rel="stylesheet" href="./css/mdb.min.css" />
    <link rel="stylesheet" href="./css/style.css" />
    <title>HeyPresh</title>
</head>

<body>
    <div class="blog-container d-block mx-auto">
        <div class="col-md-12">
            <div class="header mt-5">
                <a href="index.php" class="back-link mt-3">
                    <i class="fa fa-angle-left"></i>
                    Go Back</a>
            </div>
        </div>
    </div>

    <div class="blog-container mt-3">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <form enctype="multipart/form-data" action="create.php" method="POST">
                        <small class="font-weight-bold text-warning"><?php echo $invalidImage ?></small>
                        <label for="form4Example2">Upload blog image</label>
                        <div class="md-form md-outline m-0 mb-4">
                            <input required type="file" id="form4Example2" name="upload_image" class="form-control" />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="form4Example1">Blog Title</label>
                            <input required type="text" id="form4Example1" name="title" class="form-control" />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="form4Example3">Blog content</label>
                            <textarea required class="form-control" name="content" id="form4Example3"
                                rows="4"></textarea>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" name="post_it" class="btn btn-primary btn-block mb-4">POST</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/script.js"></script>
</body>

</html>
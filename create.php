<?php
session_start();

setlocale(LC_ALL, "US");
if (!isset($_COOKIE["username"])) {
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

    $author = $_COOKIE['username'];
    $profile_img = $_COOKIE['img_path'];
    $blog_title = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['title']));
    $blog_content = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['content']));

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
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="./css/mdb.min.css" />
	<link rel="stylesheet" href="./css/style.css" />
	<title>HeyPresh</title>
</head>

<body>
	<div class="container-fluid"
		style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('img/img4.jpg'); min-height: 100vh">

		<div class="container d-block mx-auto">
			<div class="col-md-12">
				<div class="header pt-5">
					<a href="index.php" class="back-link text-light mt-3">
						<i class="material-icons">arrow_back_sharp</i></a>
				</div>
			</div>
		</div>

		<div class="container mt-3">
			<div class="col-lg-4">
				<h1 class="fw-bold mt-3 text-white" style="font-size: 5rem">Create</h1>
			</div>
			<div class="col-md-12">
				<div class="card rounded bg-light">
					<div class="card-body">
						<form enctype="multipart/form-data" action="create.php" method="POST">

							<div class="col-12">
								<small class="font-weight-bold text-warning"><?php echo $invalidImage ?></small>
								<label for="form4Example2">Upload blog image</label>
								<input required type="file" id="form4Example2" name="upload_image" class="form-control m-0 p-1"
									style="background-color: rgba(201, 201, 201, 0.5); border: none;" />
							</div>


							<div class="col-12 mt-3">
								<label for="title">Blog Title</label>
								<div class="md-form md-outline m-0 mb-4">
									<input required type="text" id="title" name="title" class="form-control" />
								</div>
							</div>


							<div class="col-12 mt-3">
								<label class="form-label" for="form4Example3">Blog content</label>
								<div class="md-form md-outline m-0 mb-4">
									<textarea required class="form-control rounded-sm" name="content" id="form4Example3"
										rows="4"></textarea>
								</div>
							</div>

							<div class="col-12" style="position: relative">
								<!-- Submit button -->
								<button type="submit" name="post_it" style="float: right"
									class="btn btn-outline-dark rounded mb-4">POST</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="./js/jquery.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<script src="./js/popper.min.js"></script>
</body>

</html>
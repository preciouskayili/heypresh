<?php
session_start();

setlocale(LC_ALL, "US");
if (!isset($_COOKIE["username"])) {
    header('Location: 401.php');
}

include "./config/db_connect.php";

$blog_title = "";
$blog_content = "";

if (isset($_GET["id"])) {
    if (isset($_COOKIE["username"])) {
        $id = mysqli_real_escape_string($conn, $_GET["id"]);
        $username = mysqli_real_escape_string($conn, $_COOKIE["username"]);
        $query = "SELECT blog_title, blog_content FROM blogs WHERE id = '$id' AND author = '$username'";
        $response = $conn->query($query);
        $blogDetails = mysqli_fetch_all($response, MYSQLI_ASSOC);

        if ($blogDetails) {
            // return;
        } else {
            header('Location: 401.php');
        }
        if (isset($_POST['post_it'])) {
            $author = $_COOKIE['username'];
            $profile_img = $_COOKIE['img_path'];
            $blog_title = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['title']));
            $blog_content = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['content']));

            $sql = "UPDATE blogs SET blog_title = '$blog_title', blog_content = '$blog_content' WHERE author = '$username' AND id = '$id'";
            if ($conn->query($sql)) {
                header("Location: index.php");
            } else {
                header("Location: 401.php");
            }

        }
    } else {
        header('Location: 401.php');
    }
} else {
    header('Location: 401.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="./css/mdb.min.css" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="./css/style.css" />
	<title>HeyPresh</title>
</head>

<body>
	<div class="container-fluid"
		style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('img/img3.jpg'); min-height: 100vh">
		<div class="container d-block mx-auto">
			<div class="col-md-12">
				<div class="header pt-5">
					<a href="index.php" class="text-light back-link mt-3">
						<i class="material-icons ms-2">arrow_back_sharp</i></a>
				</div>
			</div>
		</div>

		<div class="container mt-3">
			<div class="col-lg-4">
				<h1 class="fw-bold text-white mt-3" style="font-size: 5rem">Update</h1>
			</div>
			<div class="col-md-11">
				<div class="card rounded bg-light">
					<div class="card-body">
						<form action="update.php?id=<?php echo $id ?>" method="POST">

							<div class="col-12 mt-3">
								<label for="title">Blog Title</label>
								<div class="md-form md-outline m-0 mb-4">
									<input required type="text" id="title" name="title" class="form-control" value="<?php
if (empty($blog_title)) {
    echo htmlspecialchars($blogDetails[0]["blog_title"]);
} else {
    echo ($blog_title);
}
?>" />
								</div>
							</div>


							<div class="col-12 mt-3">
								<label class="form-label" for="form4Example3">Blog content</label>
								<div class="md-form md-outline m-0 mb-4">
									<textarea required class="form-control rounded-sm" min="1" max="1000" name="content"
										id="form4Example3" rows="10"><?php
if (empty($blog_content)) {
    echo htmlspecialchars($blogDetails[0]["blog_content"]);
} else {
    echo htmlspecialchars($blog_content);
}
?>
		</textarea>
								</div>
							</div>

							<div class="col-md-12">
								<!-- Submit button -->
								<button type="submit" name="post_it" class="btn btn-outline-dark rounded mb-4">POST</button>
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
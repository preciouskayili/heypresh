<?php
$keyword_query = "";
include "./config/db_connect.php";
$query_structure = "SELECT id, blog_img, blog_title, profile_img, author, created_at FROM blogs WHERE deleted = 0";
$response = $conn->query($query_structure);
$allBlogs = mysqli_fetch_all($response, MYSQLI_ASSOC);

if (isset($_POST["search-btn"])) {
    $keywords = mysqli_real_escape_string($conn, $_POST["keywords"]);
    $keyword_query = $keywords;
    $sql = "SELECT id, blog_img, blog_title, profile_img, author, created_at FROM blogs WHERE deleted = 0 AND author LIKE '%$keywords%' OR deleted = 0 AND blog_title LIKE '%$keywords%' OR deleted = 0 AND blog_content LIKE '%$keywords%'";
    $response = $conn->query($sql);
    $allBlogs = mysqli_fetch_all($response, MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./css/mdb.min.css" />
	<link rel="stylesheet" href="./css/style.css" />

	<title>HeyPresh</title>
</head>

<body>
	<!-- Navbar -->
	<nav class="navbar sticky-top navbar-expand-lg bg-dark p-2 navbar-dark shadow-none">

		<a class="navbar-brand font-weight-bold ms-3" href="index.php">
			HeyPresh
		</a>

		<!-- Collapse button -->
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav1"
			aria-controls="basicExampleNav1" aria-expanded="false" aria-label="Toggle navigation">
			<i class="fa fa-bars"></i>
		</button>

		<!-- Collapsible wrapper -->
		<div class="collapse navbar-collapse" id="basicExampleNav1">
			<!-- Left -->
			<ul class="navbar-nav ms-auto">
				<li class="nav-item" style="display: <?php if (!isset($_COOKIE['username'])) {echo 'none';}?>">
					<div class="nav-link mt-3" style="cursor: pointer">
						<a class="font-weight-bold text-white" href="./create.php">
							<img src="./img/new.png" alt="create blog">
							Create blog
						</a>
					</div>
				</li>
				<!-- Dropdown -->
				<li class="nav-item dropdown" style="display: <?php if (!isset($_COOKIE['username'])) {echo 'none';}?>">
					<a class="nav-link dropdown-toggle font-weight-bold" id="navbarDropdownMenuLink" data-toggle="dropdown"
						aria-haspopup="true" aria-expanded="false">
						<img style="object-fit: cover" width="50" height="50" class="rounded-circle img-responsive"
							src="auth/profile_uploads/<?php echo $_COOKIE['img_path']; ?>" alt="">
						Welcome, <?php echo $_COOKIE["username"]; ?>
					</a>
					<div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdown-item" href="logout.php?logout=true">Logout</a>
					</div>
				</li>
				<li class="nav-item dropdown ms-auto" style="display: <?php if (isset($_COOKIE['username'])) {echo 'none';}?>">
					<a class="nav-link dropdown-toggle font-weight-bold" id="navbarDropdownMenuLink" data-toggle="dropdown"
						aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-user-ninja"></i>
						Account
					</a>
					<div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdown-item" href="./auth/login.php">Login</a>
						<a class="dropdown-item" href="./auth/signup.php">Sign Up</a>
					</div>
				</li>

			</ul>
		</div>
	</nav>
	<!-- Navbar -->


	<div class="container mt-5">
		<div class="col-lg-12 mb-5">
			<h1 class="text-dark fw-bold mt-3" style="font-size: 5rem">Precious Kayili</h1>
		</div>
		<?php if (empty($allBlogs)): include "./emptyResult.php";endif;?>

		<?php foreach ($allBlogs as $blog): ?>
		<div class="row mb-4">
			<div class="col-md-4">
				<div class="hover-zoom">
					<img style="object-fit: cover; height: 15rem" src="./blog_uploads/<?php echo $blog['blog_img'] ?>"
						class="w-100" alt="Recent article">
				</div>
			</div>
			<div class="col-md-8">
				<div class="card-body">
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto qui nesciunt harum expedita pariatur
						aliquid nobis atque in suscipit sed! Amet, minus tempora odit ea culpa praesentium sint architecto soluta.
					</p>
				</div>
			</div>
		</div>
		<?php endforeach;?>
	</div>

	<script src="./js/jquery.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<script src="./js/popper.min.js"></script>
	<script>
	const handleCopy = (blog_id) => {
		const input = document.querySelector(`.d-none#blogId${blog_id}`);
		const url = `${location.origin}/heypresh/blog.php?id=${blog_id}`;

		console.log(url, input);
		input.classList.remove("d-none");
		input.innerHTML = url;
		input.select();
		document.execCommand("copy");
		input.classList.add("d-none");
	}
	</script>
</body>

</html>
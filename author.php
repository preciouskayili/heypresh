<?php
include "./config/db_connect.php";

if (isset($_GET["author"])) {
    $author = mysqli_real_escape_string($conn, $_GET['author']);
    $query_structure = "SELECT id, blog_img, blog_content, blog_title, profile_img, author, created_at FROM blogs WHERE deleted = 0 AND author='$author'";
    $response = $conn->query($query_structure);
    $allBlogs = mysqli_fetch_all($response, MYSQLI_ASSOC);
} else {
    header('Location: index.php');
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
					<div class="nav-link mt-1" style="cursor: pointer">
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
						<img style="object-fit: cover" width="35" height="35" class="rounded-circle img-responsive"
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
		<div class="col-lg-12 mb-5 d-flex" style="align-items: center; justify-content: center;">
			<div class="profile-img" style="position: relative">
				<div class="profile-img mb-4" style="float: left; align-items: center;">
					<img style="object-fit: cover" src="./auth/profile_uploads/<?php echo $allBlogs[0]["profile_img"] ?>"
						class="img-responsive rounded-circle mt-2 me-3" width="75" style="justify-content: center" height="75"
						alt="">
				</div>
			</div>
			<div style="flex-direction: column">
				<h1 class="text-dark fw-bold" style="font-size: 5rem"><?php echo $author; ?></h1>
				<h2 class="text-dark fw-bold"><?php
if (count($allBlogs) > 1) {
    echo count($allBlogs) . " Blogs";
} else {
    echo count($allBlogs) . " Blog";
}?> </h2>
			</div>
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
					<a href="blog.php?id=<?php echo $blog["id"]; ?>">
						<h1 class="fw-bold text-dark"><?php echo $blog["blog_title"]; ?></h1>
					</a>
					<p style="overflow: hidden;
							text-overflow: ellipsis;
							display: -webkit-box;
							-webkit-line-clamp: 4;
							line-clamp: 4;
							-webkit-box-orient: vertical;">
						<?php echo $blog["blog_content"] ?>
					</p>
					<span class="badge badge-primary"><?php
$format = "M d, Y";
$created_at = new DateTime($blog["created_at"]);
echo date_format($created_at, $format);
?></span>
				</div>
			</div>
		</div>
		<?php endforeach;?>
	</div>

	<script src="./js/jquery.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<script src="./js/popper.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<script>
	const handleCopy = (blog_id) => {
		const input = document.querySelector(`.d-none#blogId${blog_id}`);
		const url = `${location.origin}/heypresh/blog.php?id=${blog_id}`;

		console.log(url, input);
		input.classList.remove("d-none");
		input.innerHTML = url;
		input.select();
		if (document.execCommand("copy")) {
			Swal.fire({
				icon: 'success',
				title: 'Your work has been saved',
				showConfirmButton: false,
				timer: 1500
			})
			input.classList.add("d-none");
		} else {
			Swal.fire({
				title: "Good job!",
				text: "You clicked the button!",
				icon: "error",
				button: "Aww yiss!",
			});
		}
	}
	</script>
</body>

</html>
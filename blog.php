<?php
include "controllers/Blog.php";
setlocale(LC_ALL, "US");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
	<link rel="stylesheet" href="./css/mdb.min.css" />
	<link rel="stylesheet" href="./css/style.css" />
	<title>HeyPresh</title>
</head>

<body>
	<!-- <div class="container">

	</div> -->
	<?php if (empty($blogPost)): include "./emptyResult.php";endif;?>
	<?php foreach ($blogPost as $blog): ?>
	<div class="container-fluid"
		style="background: linear-gradient(to bottom right, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url(./blog_uploads/<?php echo $blog['blog_img']; ?>); background-size: cover; background-position: center; background-attachment: fixed">
		<div class="pt-3">
			<div class="header" style="position: relative">
				<a href="index.php" class="back-link mt-3 text-white">
					<i class="fas fa-arrow-left me-2"></i>
					Go Back</a>
				<!-- href="./controllers/DeleteBlog.php?delete=<?php echo $blogPost[0]['id']; ?>" -->
				<button onclick="handleDelete()"
					style="display: <?php if (isset($_COOKIE["username"]) && $blogPost[0]['author'] == $_COOKIE['username']) {echo 'initial';} else {echo 'none';}?>; float: right; background-color: #e00202; border-radius: 0.50rem"
					class="btn shadow-none text-white btn-md back-link">
					Delete</button>
			</div>
			<div class="row" style="min-height: 100vh; align-items: center; justify-content: center">
				<div class="col-md-6">
					<h1 class="text-white fw-bold mt-3 display-2">
						<?php echo $blog["blog_title"]; ?>
					</h1>
					<p id="time" class="fw-bold text-light"><?php echo round(strlen($blog['blog_content']) / 300, 0); ?> min. read
					</p>
				</div>
				<div class="col-md-6">
					<div class="blog-img">
						<img style="object-fit: cover;" src="./blog_uploads/<?php echo $blog['blog_img']; ?>"
							class="w-100 shadow rounded" alt="Blog Image" />
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<p class="text text-dark mt-5" style="font-family: 'Lora', serif;">
			<?php echo $blog["blog_content"]; ?>
		</p>
		<div class="title-section mt-5 col-lg-3 col-md-6 ms-auto">
			<div class="card">
				<div class="d-flex my-auto">
					<div class="profile-img hover-zoom">
						<img style="object-fit: cover" src="./auth/profile_uploads/<?php echo $blog["profile_img"]; ?>" width="100"
							height="100" alt="Profile img" />
					</div>
					<div class="details my-auto ms-3">
						<a href="author.php?author=<?php echo $blog["author"] ?>" class="text-dark author-name fw-bold">
							<p><?php echo $blog["author"]; ?></p>
						</a>
						<p class="text-muted desc">Author</p>
						<small class="date fw-bold text-muted"><?php
$format = "M d, Y";
$created_at = new DateTime($blog["created_at"]);
echo date_format($created_at, $format);
?></small>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endforeach;?>
	</div>
	<div class="container">
		<?php if (!empty($blogPost)): ?>
		<div class="col-md-12">
			<div class="recent-section">
				<h3 class="text-dark fw-bold">
					Recent Articles
				</h3>

				<div class="container-fluid">
					<div class="row">
						<?php foreach ($recent_blogs as $recent_blog): ?>
						<div class="col-md-4">
							<div class="card bg-light rounded mt-4 mb-3">
								<a class="blog-link text-dark" href="blog.php?id=<?php echo $recent_blog['id']; ?>">
									<div class="hover-zoom">
										<img style="object-fit: cover; height: 15rem;"
											src="./blog_uploads/<?php echo $recent_blog['blog_img'] ?>" class="w-100 card-img-top"
											alt="Recent article">
									</div>
								</a>
								<div class="card-body">
									<a class="blog-link text-dark" href="blog.php?id=<?php echo $recent_blog['id']; ?>">
										<h4 class="fw-bold mt-3 text-truncate card-title" title="<?php echo $recent_blog["blog_title"]; ?>">
											<?php echo $recent_blog["blog_title"]; ?>
										</h4>
									</a>
									<div class="authors-profile mt-3">
										<div class="d-flex my-auto">
											<div class="profile-img">
												<img class="rounded-circle" style="object-fit: cover;"
													src="./auth/profile_uploads/<?php echo $recent_blog['profile_img']; ?>" width="40" height="40"
													alt="Profile img" />
											</div>

											<div class="details my-auto ms-2" style="padding-top: 10px">
												<a href="author.php?author=<?php echo $recent_blog['author']; ?>"
													style="font-size: 12px; line-height: 0px" class="fw-bold author-name">
													<p class="text-dark"><?php echo $recent_blog['author']; ?></p>
												</a>
												<p style="font-size: 12px;" class="date text-muted"><?php
$format = "M d, Y";
$created_at = new DateTime($blog["created_at"]);
echo date_format($created_at, $format);
?></p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php endforeach;?>
					</div>
				</div>
			</div>
		</div>
		<?php endif;?>
	</div>

	<script src="./js/sweetalert2.all.min.js"></script>
	<script>
	const handleDelete = () => {
		Swal.fire({
			icon: 'error',
			title: 'Are you sure you want to delete this blog',
			showDenyButton: true,
			denyButtonText: 'Cancel',
			showCloseButton: true,
			confirmButtonText: 'Yes',
			showLoaderOnConfirm: false,
		})
	}
	console.log(Swal.getActions());
	</script>
</body>

</html>
<?php
session_start();
if (!isset($_SESSION["username"])) {
    header('Location: auth/login.php');
}
$keyword_query = "";
include "./config/db_connect.php";
$query_structure = "SELECT id, blog_img, blog_title, profile_img, author, created_at FROM blogs";
$response = $conn->query($query_structure);
$allBlogs = mysqli_fetch_all($response, MYSQLI_ASSOC);

if (isset($_POST["search-btn"])) {
    $keywords = mysqli_real_escape_string($conn, $_POST["keywords"]);
    $keyword_query = $keywords;
    $sql = "SELECT id, blog_img, blog_title, profile_img, author, created_at FROM blogs WHERE author LIKE '%$keywords%' OR blog_title LIKE '%$keywords%' OR blog_content LIKE '%$keywords%'";
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
    <link rel="stylesheet" href="./css/bootstrap.min.css" />
    <link rel="stylesheet" href="./css/mdb.min.css" />
    <link rel="stylesheet" href="./css/style.css" />

    <title>HeyPresh</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar sticky-top navbar-expand-lg bg-dark p-3 navbar-dark shadow-none">

        <a class="navbar-brand font-weight-bold ml-5" href="index.php">
            HeyPresh
        </a>

        <!-- Collapse button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav1"
            aria-controls="basicExampleNav1" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-align-left"></i>
        </button>

        <!-- Left -->
        <ul class="navbar-nav ml-auto">
            <!-- Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle font-weight-bold" id="navbarDropdownMenuLink" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <img style="object-fit: cover" width="50" height="50" class="rounded-circle ml-5 img-responsive"
                        src="auth/profile_uploads/<?php echo $_SESSION['img_path']; ?>" alt="">
                    Welcome, <?php echo $_SESSION["username"]; ?>
                </a>
                <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="logout.php?logout=true">Logout</a>
                </div>
            </li>

            <div class="nav-item">
                <div class="nav-link mt-2 ml-3" style="cursor: pointer">
                    <a href="./create.php">
                        <img src="./img/new.png" alt="create blog">
                    </a>
                </div>
            </div>
        </ul>
    </nav>
    <!-- Navbar -->

    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <h1 class="font-weight-bold mt-3" style="font-size: 5rem">Blogs</h1>
            </div>

            <div class="col-md-8 my-auto">
                <form action="index.php" method="POST" class="search m-0 form-inline">
                    <div class="md-form md-outline m-0 w-100">
                        <input name="keywords" required placeholder="Search" value="<?php echo $keyword_query; ?>"
                            autocomplete="off" type="text" id="form77"
                            style="background-color: rgba(201, 201, 201, 0.5); border: none;" class="form-control m-0">
                        <button name="search-btn" class="btn btn-md btn-dark" style="border-radius: 0.40rem">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div class="container mt-5">
        <?php if (empty($allBlogs)): include "./emptyResult.php";endif;?>

        <div class="row">
            <?php foreach ($allBlogs as $blog): ?>
            <div class="col-lg-4 col-md-6">
                <div class="card shadow-none">
                    <div class="profile-img mb-2">
                        <img style="object-fit: cover" src="./auth/profile_uploads/<?php echo $blog["profile_img"] ?>"
                            class="img-responsive rounded-circle" width="50" height="50" alt="">
                        <small class="ml-2 font-weight-bold"><?php echo $blog["author"] ?></small>
                    </div>
                    <a class="text-dark blog-card" href="blog.php?id=<?php echo $blog["id"]; ?>">
                        <div class="card-img-top shadow-none">
                            <img style="object-fit: cover" src="./blog_uploads/<?php echo $blog["blog_img"] ?>"
                                class="img-responsive w-100" alt="">
                        </div>
                        <h3 class="font-weight-bold mt-3"><?php echo $blog["blog_title"] ?></h3>
                        <small class="mt-2 text-muted"><?php
$format = "M d, Y";
$created_at = new DateTime($blog["created_at"]);
echo date_format($created_at, $format);
?></small>
                    </a>
                </div>
            </div>
            <?php endforeach;?>
        </div>
    </div>

    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/script.js"></script>
</body>

</html>
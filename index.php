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
    <link rel="stylesheet" href="./css/bootstrap.min.css" />
    <link rel="stylesheet" href="./css/mdb.min.css" />
    <link rel="stylesheet" href="./css/style.css" />

    <title>HeyPresh</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar sticky-top navbar-expand-lg bg-dark p-2 navbar-dark shadow-none">

        <a class="navbar-brand font-weight-bold ml-3" href="index.php">
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
            <ul class="navbar-nav ml-auto">
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
                    <a class="nav-link dropdown-toggle font-weight-bold" id="navbarDropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img style="object-fit: cover" width="50" height="50" class="rounded-circle img-responsive"
                            src="auth/profile_uploads/<?php echo $_COOKIE['img_path']; ?>" alt="">
                        Welcome, <?php echo $_COOKIE["username"]; ?>
                    </a>
                    <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="logout.php?logout=true">Logout</a>
                    </div>
                </li>
                <li class="nav-item dropdown" style="display: <?php if (isset($_COOKIE['username'])) {echo 'none';}?>">
                    <a class="nav-link dropdown-toggle font-weight-bold" id="navbarDropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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

    <div class="container shadow mt-4 rounded p-3" style="background-color: #e5e5ea">
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
            <div class="col-lg-4 mb-4 col-md-6">
                <div class="card bg-light rounded">
                    <div class="card-body">

                        <div class="profile-img" style="position: relative">
                            <div class="profile-img mb-4" style="float: left;">
                                <img style="object-fit: cover"
                                    src="./auth/profile_uploads/<?php echo $blog["profile_img"] ?>"
                                    class="img-responsive rounded-circle" width="50" height="50" alt="">
                                <small class="ml-2 font-weight-bold"><?php echo $blog["author"] ?></small>
                            </div>
                        </div>
                        <a class="text-dark blog-card pt-3" href="blog.php?id=<?php echo $blog["id"]; ?>">
                            <div class="card-img-top shadow-none">
                                <div class="hover-zoom">
                                    <img style="object-fit: cover; height: 15rem"
                                        src="./blog_uploads/<?php echo $blog["blog_img"] ?>"
                                        class="img-responsive rounded w-100" alt="">
                                </div>
                            </div>
                            <h3 class="font-weight-bold text-truncate card-title mt-3"
                                title="<?php echo $blog["blog_title"]; ?>"><?php echo $blog["blog_title"] ?>
                            </h3>

                            <div class="card-icons mt-3 mr-2" style="position: relative;">
                                <div class="icons" style="float: left;">
                                    <a style="display: <?php if (isset($_COOKIE["username"]) && $blog['author'] == $_COOKIE['username']) {echo 'initial';} else {echo 'none';}?>"
                                        href="./update.php?id=<?php echo $blog['id']; ?>" class="text-muted">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <textarea class="d-none" id="blogId<?php echo $blog['id']; ?>"></textarea>
                                    <button class="btn btn-md p-0 shadow-none" style="color: #707070"
                                        onclick="handleCopy(<?php echo $blog['id']; ?>)" title="Copy link to clipboard">
                                        <i class="fa fa-paper-plane"></i>
                                    </button>
                                </div>
                                <div class="date" style="float: right;">

                                    <small class="mt-2 text-muted">
                                        <?php
$format = "M d, Y";
$created_at = new DateTime($blog["created_at"]);
echo date_format($created_at, $format);
?>
                                    </small>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </div>
    </div>

    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script>
    const handleCopy = (blog_id) => {
        const input = document.getElementById(`blogId${blog_id}`);
        const url = `${location.origin}/heypresh/blog.php?id=${blog_id}`;

        input.innerHTML = url;
        input.select();
        document.execCommand("copy");
    }
    </script>
</body>

</html>
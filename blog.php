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
    <link rel="stylesheet" href="./css/bootstrap.min.css" />
    <link rel="stylesheet" href="./css/mdb.min.css" />
    <link rel="stylesheet" href="./css/style.css" />
    <title>HeyPresh</title>
</head>

<body>
    <div class="container-fluid">
        <div class="header mt-5" style="position: relative">
            <a href="index.php" class="back-link mt-3">
                <i class="fa fa-angle-left"></i>
                Go Back</a>

            <a href="./controllers/DeleteBlog.php?delete=<?php echo $blogPost[0]['id']; ?>"
                style="display: <?php if (isset($_COOKIE["username"]) && $blogPost[0]['author'] == $_COOKIE['username']) {echo 'initial';} else {echo 'none';}?>; float: right; background-color: #e00202; border-radius: 0.50rem"
                class="btn shadow-none text-white btn-md back-link mt-3">
                Delete</a>
        </div>

        <?php if (empty($blogPost)): include "./emptyResult.php";endif;?>
        <?php foreach ($blogPost as $blog): ?>
        <div class="title-section mt-4">
            <h1 class="title mt-3">
                <?php echo $blog["blog_title"]; ?>
            </h1>
            <div class="d-flex my-auto">
                <div class="profile-img">
                    <img style="object-fit: cover" class="rounded-circle"
                        src="./auth/profile_uploads/<?php echo $blog["profile_img"]; ?>" width="75" height="75"
                        alt="Profile img" />
                </div>
                <div class="details my-auto ml-2">
                    <p class="text-dark author-name"><?php echo $blog["author"]; ?></p>
                    <p class="text-muted font-weight-bold desc">Author</p>
                    <small class="date font-weight-bold text-muted"><?php
$format = "M d, Y";
$created_at = new DateTime($blog["created_at"]);
echo date_format($created_at, $format);
?></small>
                </div>
            </div>

        </div>
        <div class="blog-content mt-5">
            <div class="blog-img">
                <img style="object-fit: cover; height: 25rem" src="./blog_uploads/<?php echo $blog['blog_img']; ?>"
                    class="img-responsive w-100 shadow rounded" alt="Blog Image" />
            </div>

            <p class="text text-dark mt-5">
                <?php echo $blog["blog_content"]; ?>
            </p>
        </div>
        <?php endforeach;?>
        <?php if (!empty($blogPost)): ?>
        <div class="col-md-12">
            <div class="recent-section">
                <h3 class="font-weight-bold">
                    Recent Articles
                </h3>

                <div class="container-fluid">
                    <div class="row">
                        <?php foreach ($recent_blogs as $recent_blog): ?>
                        <div class="col-md-4">
                            <div class="card bg-light rounded mt-4 mb-3">
                                <div class="card-body">
                                    <a class="blog-link text-dark" href="blog.php?id=<?php echo $recent_blog['id']; ?>">
                                        <img style="object-fit: cover; height: 15rem"
                                            src="./blog_uploads/<?php echo $recent_blog['blog_img'] ?>"
                                            class="w-100 rounded" alt="Recent article">
                                    </a>
                                    <a class="blog-link text-dark" href="blog.php?id=<?php echo $recent_blog['id']; ?>">
                                        <h4 class="font-weight-bold mt-3 text-truncate card-title"
                                            title="<?php echo $recent_blog["blog_title"]; ?>">
                                            <?php echo $recent_blog["blog_title"]; ?>
                                        </h4>
                                    </a>
                                    <div class="authors-profile mt-3">
                                        <div class="d-flex my-auto">
                                            <div class="profile-img">
                                                <img class="rounded-circle" style="object-fit: cover;"
                                                    src="./auth/profile_uploads/<?php echo $recent_blog['profile_img']; ?>"
                                                    width="40" height="40" alt="Profile img" />
                                            </div>
                                            <div class="details my-auto ml-2" style="padding-top: 10px">
                                                <p style="font-size: 12px; line-height: 0px"
                                                    class="font-weight-bold author-name">
                                                    <?php echo $recent_blog['author']; ?></p>
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
    </div>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/popper.min.js"></script>
</body>

</html>
<?php
include "controllers/Blog.php";
setlocale(LC_ALL, "US");
session_start();
if (!isset($_SESSION["username"])) {
    header('Location: auth/login.php');
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
            <?php if (empty($blogPost)): include "./emptyResult.php";endif;?>
            <div class="row">
                <?php foreach ($blogPost as $blog): ?>
                <div class="col-md-12 col-lg-7">
                    <div class="title-section mt-4">
                        <h1 class="title mt-3">
                            <?php echo $blog["blog_title"]; ?>
                        </h1>
                        <div class="authors-profile mt-3 bg-primary p-3">
                            <div class="d-flex my-auto">
                                <div class="profile-img">
                                    <img style="object-fit: cover" class="rounded-circle"
                                        src="./auth/profile_uploads/<?php echo $blog["profile_img"]; ?>" width="75"
                                        height="75" alt="Profile img" />
                                </div>
                                <div class="details my-auto ml-2">
                                    <p class="text-white author-name"><?php echo $blog["author"]; ?></p>
                                    <p class="text-white font-weight-bold desc">Author</p>
                                    <small class="date font-weight-bold text-white"><?php
$format = "M d, Y";
$created_at = new DateTime($blog["created_at"]);
echo date_format($created_at, $format);
?></small>
                                </div>
                            </div>
                        </div>

                        <div class="blog-content">
                            <div class="blog-img">
                                <img style="object-fit: cover" src="./blog_uploads/<?php echo $blog['blog_img']; ?>"
                                    class="img-responsive w-100 shadow-lg" alt="Blog Image" />
                            </div>

                            <div class="content p-4 mb-3" style="background-color: #0047ba;">
                                <p class="text text-light">
                                    <?php echo $blog["blog_content"]; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
                <?php if (!empty($blogPost)): ?>
                <div class="d-none d-lg-block col-md-5">
                    <div class="recent-section">
                        <h3 class="font-weight-bold">
                            Recent Articles
                        </h3>

                        <?php foreach ($recent_blogs as $recent_blog): ?>
                        <div class="recent-card mt-4 mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <a class="blog-link text-dark" href="blog.php?id=<?php echo $recent_blog['id']; ?>">
                                        <img src="./blog_uploads/<?php echo $recent_blog['blog_img'] ?>"
                                            class="w-100 rounded" alt="Recent article">
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a class="blog-link text-dark" href="blog.php?id=<?php echo $recent_blog['id']; ?>">
                                        <h4 class="font-weight-bold">
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
                                                    class="font-weight-bold author-name">Precious Kayili</p>
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
                <?php endif;?>
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
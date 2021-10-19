<!DOCTYPE html>
<html lang="en">
<?php include "./middleware/Signup.php";?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../admin/css/icons/font-awesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/mdb.min.css">
    <title>HeyPresh</title>
</head>

<style>
html,
body {
    height: 100%;
}

body {
    display: flex;
    justify-content: center;
    /* horizontal center */
    align-items: center;
    /* vertical center */
}
</style>

<body>
    <div class="container-fluid">
        <form action="signup.php" method="post" enctype="multipart/form-data" class="flex-center"
            style="flex-direction: column;">
            <h3 class="font-weight-bold mb-4 mt-4">HeyPresh</h3>

            <div class="col-lg-4 col-md-5">
                <label class="form-label" for="form1">Choose profile image</label>
                <div class="md-form md-outline m-0 mb-4">
                    <input required name="upload_image" type="file" id="form1" class="form-control"
                        autocomplete="off" />

                    <small class="text-warning font-weight-bold">
                        <?php echo $invalidImage; ?>
                    </small>
                </div>
            </div>

            <div class="col-lg-4 col-md-5">
                <div class="md-form md-outline m-0 mb-4">
                    <input required name="email" type="text" id="form1" value="<?php echo $email; ?>"
                        class="form-control" autocomplete="off" />
                    <label class="form-label" for="form1">Email</label>

                    <small class="text-warning font-weight-bold">
                        <?php echo $errors['email']; ?>
                    </small>
                </div>
            </div>

            <div class="col-lg-4 col-md-5">
                <div class="md-form md-outline m-0 mb-4">
                    <input required name="username" type="text" id="form1" value="<?php echo $username; ?>"
                        class="form-control" autocomplete="off" />
                    <label class="form-label" for="form1">Username</label>

                    <small class="text-warning font-weight-bold">
                        <?php echo $errors["username"]; ?>
                    </small>
                </div>
            </div>

            <div class="col-lg-4 col-md-5">
                <div class="md-form md-outline m-0 mb-4">
                    <input required name="password" type="password" id="form1" class="form-control"
                        autocomplete="off" />
                    <label class="form-label" for="form1">Password</label>

                    <small class="text-warning font-weight-bold">
                        <?php echo $errors["password"]; ?>
                    </small>
                </div>
            </div>

            <div class="col-lg-4 col-md-5">
                <button name="signup" class="col-md-12 btn btn-warning" style="margin-left: -0.05rem;">Sign Up</button>
                <div class="sign-up-link mt-4 text-muted">
                    <span>Already a member? </span><a href="login.php">Sign in</a>
                </div>
            </div>
        </form>
    </div>

    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/popper.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/mdb.min.js"></script>
</body>
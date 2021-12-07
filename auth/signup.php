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
.color {
    height: 40vh;
    background-color: #4285f4;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>


<body>
    <div class="color py-auto text-white my-auto text-center">
        <div class="d-block">
            <h1 class="font-weight-bold text-center title">Signup</h1>
            <p class="text-center font-weight-bold">HeyPresh</p>
        </div>
    </div>
    <div class="mb-3 container-fluid mx-auto" style="margin-top: -2rem;">
        <div class="col-lg-5 col-md-7 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form action="signup.php" method="post" enctype="multipart/form-data">
                        <div class="col-12">
                            <label class="form-label" for="form1">Choose profile image</label>
                            <div class="md-form md-outline m-0 mb-4">
                                <input required name="upload_image" type="file" id="form1" class="form-control"
                                    autocomplete="off" />

                                <small class="text-warning font-weight-bold">
                                    <?php echo $invalidImage; ?>
                                </small>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="md-form md-outline m-0 mb-4">
                                <input required name="email" type="text" id="form2" value="<?php echo $email; ?>"
                                    class="form-control" autocomplete="off" />
                                <label class="form-label" for="form2">Email</label>

                                <small class="text-warning font-weight-bold">
                                    <?php echo $errors['email']; ?>
                                </small>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="md-form md-outline m-0 mb-4">
                                <input required name="username" type="text" id="form3" value="<?php echo $username; ?>"
                                    class="form-control" autocomplete="off" />
                                <label class="form-label" for="form3">Username</label>

                                <small class="text-warning font-weight-bold">
                                    <?php echo $errors["username"]; ?>
                                </small>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="md-form md-outline m-0 mb-4">
                                <input required name="password" type="password" id="form4" class="form-control"
                                    autocomplete="off" />
                                <label class="form-label" for="form4">Password</label>

                                <small class="text-warning font-weight-bold">
                                    <?php echo $errors["password"]; ?>
                                </small>
                            </div>
                        </div>

                        <div class="col-12">
                            <button name="signup" class="col-md-12 btn btn-warning" style="margin-left: -0.05rem;">Sign
                                Up</button>
                            <div class="sign-up-link mt-4 text-muted">
                                <span>Already a member? </span><a href="login.php">Sign in</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/popper.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/mdb.min.js"></script>
</body>
<!DOCTYPE html>
<html lang="en">
<?php session_start();?>
<?php include "./middleware/Login.php";?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

<script>
const showPassword = () => {

    const password = document.getElementById("password")

    if (password.type === 'text') {
        password.type = 'password'
    } else {
        password.type = 'text'
    }
}
</script>

<body>
    <div class="color py-auto text-white my-auto text-center">
        <div class="d-block">
            <h1 class="font-weight-bold text-center title">Login</h1>
            <p class="text-center font-weight-bold">HeyPresh</p>
        </div>
    </div>
    <div class="container-fluid mx-auto" style="margin-top: -2rem;">
        <div class="col-lg-5 col-md-7 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form action="login.php" method="post">
                        <small class="text-danger font-weight-bold">
                            <?php echo $invalid; ?>
                        </small>
                        <div class="col-12 mt-3">
                            <div class="md-form md-outline m-0 mb-4">
                                <input name="username" type="text" id="form1" value="<?php echo $username; ?>"
                                    class="form-control border-2" autocomplete="off" />
                                <label class="form-label" for="form1">Username</label>

                                <small class="text-warning font-weight-bold">
                                    <?php echo $errors["username"]; ?>
                                </small>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="md-form md-outline m-0 mb-4">
                                <input name="password" type="password" id="password" class="form-control"
                                    autocomplete="off" />
                                <label class="form-label" for="password">Password</label>

                                <small class="text-warning font-weight-bold">
                                    <?php echo $errors["password"]; ?>
                                </small>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-check mt-2 mb-2">
                                <input class="form-check-input" type="checkbox" id="flexCheckChecked"
                                    onclick="showPassword()" />
                                <label class="form-check-label" style="color: #777" for="flexCheckChecked">
                                    Show Password
                                </label>
                            </div>
                            <button name="signin" class="col-md-12 btn btn-warning"
                                style="margin-left: -0.05rem;">Login</button>
                            <div class="sign-up-link mt-3 text-muted">
                                <span>Not yet a member? </span><a href="signup.php">Sign up</a>
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
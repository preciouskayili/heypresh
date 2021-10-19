<!DOCTYPE html>
<html lang="en">
<?php include "./middleware/Login.php";?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    align-items: center;
    /* vertical center */
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
    <div class="container-fluid">
        <form action="login.php" method="post" class="flex-center" style="flex-direction: column;">
            <h3 class="font-weight-bold mb-4">HeyPresh</h3>
            <small class="text-danger font-weight-bold">
                <?php echo $invalid; ?>
            </small>
            <div class="col-lg-4 col-md-5">
                <div class="md-form md-outline m-0 mb-4">
                    <input name="username" type="text" id="form1" value="<?php echo $username; ?>" class="form-control"
                        autocomplete="off" />
                    <label class="form-label" for="form1">Username</label>

                    <small class="text-warning font-weight-bold">
                        <?php echo $errors["username"]; ?>
                    </small>
                </div>
            </div>

            <div class="col-lg-4 col-md-5">
                <div class="md-form md-outline m-0 mb-4">
                    <input name="password" type="password" id="password" class="form-control" autocomplete="off" />
                    <label class="form-label" for="password">Password</label>

                    <small class="text-warning font-weight-bold">
                        <?php echo $errors["password"]; ?>
                    </small>
                </div>
            </div>

            <div class="col-lg-4 col-md-5">
                <div class="form-check mt-2 mb-2">
                    <input class="form-check-input" type="checkbox" id="flexCheckChecked" onclick="showPassword()" />
                    <label class="form-check-label" style="color: #777" for="flexCheckChecked">
                        Show Password
                    </label>
                </div>
                <button name="signin" class="col-md-12 btn btn-warning" style="margin-left: -0.05rem;">Login</button>
                <div class="sign-up-link mt-3 text-muted">
                    <span>Not yet a member? </span><a href="signup.php">Sign up</a>
                </div>
            </div>
        </form>
    </div>

    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/popper.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/mdb.min.js"></script>
</body>
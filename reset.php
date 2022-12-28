<?php
require_once 'conn.php';
if ($_SESSION['rid'] == $_REQUEST['id']) {
    $id = $_GET['id'];
} else {
    header("location: login.php");
}
if (isset($_POST['reset'])) {
    $errorcheck = 0;
    // password validation
    $password = trim($_POST['password']);
    if (empty($password)) {
        $passwordErr = "Please enter your password";
        $errorcheck = 1;
    }

    // confirm password validation
    $cpassword = trim($_POST['cpassword']);
    if (empty($cpassword)) {
        $cpasswordErr = "Please enter your confirm password";
        $errorcheck = 1;
    } elseif ($password != $cpassword) {
        $cpasswordErr = "confirm password not matched with password";
        $errorcheck = 1;
    }
    if ($errorcheck == 0) {
        // $sql = "UPDATE `users` SET `password` = md5('$password') where `id` = '$id'";
        // $result = mysqli_query($conn, $sql);

        $r = new Users();
        $r->reset('users', ['password' => $password], $id);
        $result = $r->sql;

        if ($result) {
            header("location: logout.php");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<style>
    .error {
        color: red;
    }
</style>

<body>
    <?php
    require_once 'navbar.php';
    ?>
    <div class="container">
        <h1>Please Reset Password</h1>
        <form action="" id="reset" method="post">
            <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <a href="" id="showpassword" class="showhidefont"><i class="fa-solid fa-eye-slash"></i></a>
                <span class="error" id="passwordErr" name="passwordErr">*<?php echo $passwordErr; ?></span>
                <input type="password" class="form-control" placeholder="Enter your password" value="<?php echo $password; ?>" id="password" name="password">
            </div>
            <div class="col-md-6">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <a href="" id="showcpassword" class="showhidefont"><i class="fa-solid fa-eye-slash"></i></a>
                <span class="error" id="cpasswordErr" name="cpasswordErr">*<?php echo $cpasswordErr; ?></span>
                <input type="password" class="form-control" placeholder="Enter your confirm password" value="<?php echo $cpassword; ?>" id="cpassword" name="cpassword">
            </div>
            <button type="submit" name="reset" id="reset" class="btn btn-primary mt-2">Reset</button>
        </form>
    </div>

    <script>

    </script>

</body>

</html>
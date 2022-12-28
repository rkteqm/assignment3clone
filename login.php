<?php

require_once 'conn.php';
// define variables
$email = $password = "";
$emailErr = $passwordErr = $validErr = "";
$showError = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $email = trim($_POST['email']);
  $password = trim($_POST['password']);

  // email validation
  if (empty($email)) {
    $emailErr = "Please enter your email";
    $errorcheck = 1;
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $emailErr = "Please enter valid email";
    $errorcheck = 1;
  }

  // password validation
  if (empty($password)) {
    $passwordErr = "Please enter your password";
    $errorcheck = 1;
  }

  if (empty($emailErr) && empty($passwordErr)) {
    $a = new Users();
    $a->login('users', ['email' => $email, 'password' => $password]);
    $result = $a->sql;
    $num = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    $id = $row['id'];
    $user_type = $row['user_type'];

    if ($num == 1 && $user_type == "0") {
      $_SESSION['id'] = $id;
      $_SESSION['admin'] = 'admin';
      header("location: users.php?loginsuccess=1");
    } elseif ($num == 1 && $user_type == "1") {
      $_SESSION['id'] = $id;
      $_SESSION['client'] = 'client';
      echo $_SESSION['id'];
      echo $_SESSION['client'];
      header("location: client.php?loginsuccess=1");
    } else {
      echo mysqli_error($conn);
      $showError = 1;
      $validErr = "Please enter correct details for login...";
    }
  }
}

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="./assets/js/loginscript.js"></script>

  <style>
    .error {
      color: red;
    }
  </style>
</head>

<body>
  <?php
  require_once 'navbar.php';
  if ($showError == 1) {
  ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <span><?php echo $validErr ?></span>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php
  }
  ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert" id="resetmessage" style="display: none;">
    <span>Reset link has been sent to your email</span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <div class="container mt-5 form">
    <h1>Please Login Here</h1>
    <hr><br>
    <form class="row g-3" method="post" id="form">
      <div class="col-md-6">
        <label for="email" class="form-label">E-Mail</label>
        <span class="error" id="emailErr" name="emailErr">*<?php echo $emailErr; ?></span>
        <input type="text" class="form-control" placeholder="Enter your email" value="<?php echo $email; ?>" id="email" name="email">
      </div>
      <div class="col-md-6">
        <label for="password" class="form-label">Password</label>
        <span class="error" id="passwordErr" name="passwordErr">*<?php echo $passwordErr; ?></span>
        <input type="password" class="form-control" placeholder="Enter your password" value="<?php echo $password; ?>" id="password" name="password">
      </div>
      <div class="col-12">
        <button type="submit" name="login" id="login" class="btn btn-primary">Login</button>
        <button type="button" class="btn btn-primary" id="fp" data-bs-toggle="modal" data-bs-target="#myModal">Forgot Password</button>
        <!-- <a href="" class="forgot">Forgot Password</a> -->
      </div>
    </form>
  </div>
  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Reset Password</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <form action="" id="modal">
          <div class="modal-body">
            <label for="emailf" class="form-label">E-Mail</label>
            <span class="error" id="emailErrf" name="emailErrf">*<?php echo $emailErrf; ?></span>
            <input type="text" class="form-control" placeholder="Enter your email" value="<?php echo $emailf; ?>" id="emailf" name="emailf">
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" id="forgot-back-btn" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="forgot">Send link</button>
          </div>
        </form>

      </div>
    </div>
  </div>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>
<?php
if (isset($_POST['email'])) {

    require_once 'conn.php';

    $errorcheck = 0;

    // email validation
    $email = trim($_POST['email']);
    if (empty($email)) {
        $emailErr = "Please enter your email";
        $errorcheck = 1;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Please enter valid email";
        $errorcheck = 1;
    }

    if ($errorcheck == 0) {
        // $sql = " SELECT * FROM `users` WHERE `email` = '$email'";
        // $result = mysqli_query($conn, $sql);
        // $num = mysqli_num_rows($result);
        // $email = trim($_POST['email']);
        $ee = new Users();
        $ee->emailExist('users', ['email' => $email]);
        $result = $ee->sql;
        $num = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        if ($num == 1) {
            $id = $row['id'];
            $_SESSION['rid'] = $id;
            echo $id;
        } else {
            echo "0";
        }
    }
}

<?php
require_once 'conn.php';
// define variables
$fname = $lname = $email = $phone = $password = $cpassword = $gender = $created_date = $modified_date = "";
$fnameErr = $lnameErr = $emailErr = $phoneErr = $passwordErr = $cpasswordErr = $genderErr = "";
$errorcheck = 1;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errorcheck = 0;
    $created_date = date("l jS \of F Y h:i:s A");

    // file validation
    $target_dir = "assets/images/";
    $file = $_FILES['file']['name'];
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    $allowed_image_extension = array("png", "jpg", "jpeg");

    // file validation
    if (empty($_FILES["file"]["name"])) {
        $fileErr = 'Please select image';
        $errorcheck = 1;
    }
    // Check file size
    elseif ($_FILES["file"]["size"] > 50000) {
        $fileErr = 'Sorry, your file is greater than 50kb.';
        $errorcheck = 1;
    } elseif (!in_array($imageFileType, $allowed_image_extension)) {
        $fileErr = 'Sorry, only JPG, JPEG & PNG files are allowed.';
        $errorcheck = 1;
    }

    // first name validation
    $fname = trim($_POST['fname']);
    if (empty($fname)) {
        $fnameErr = "Please enter your first name";
        $errorcheck = 1;
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $fname)) {
        $fnameErr = "Please enter characters only";
        $errorcheck = 1;
    } else if (strlen($fname) < 3) {
        $fnameErr = "Please enter at least 3 characters";
        $errorcheck = 1;
    }

    // last name validation
    $lname = trim($_POST['lname']);
    if (empty($lname)) {
        $lnameErr = "Please enter your last name";
        $errorcheck = 1;
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $lname)) {
        $lnameErr = "Please enter characters only";
        $errorcheck = 1;
    } else if (strlen($lname) < 3) {
        $lnameErr = "Please enter at least 3 characters";
        $errorcheck = 1;
    }

    // email validation
    $email = trim($_POST['email']);
    $ee = new Users();
    $ee->emailExist('users', ['email' => $email]);
    $result = $ee->sql;
    $num = mysqli_num_rows($result);

    if (empty($email)) {
        $emailErr = "Please enter your email";
        $errorcheck = 1;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Please enter valid email";
        $errorcheck = 1;
    } elseif ($num == 1) {
        $emailErr = "Email already exist";
        echo "emailerror";
        $errorcheck = 1;
    }

    // phone number validation
    $phone = trim($_POST['phone']);
    if (empty($phone)) {
        $phoneErr = "Please enter your phone number";
        $errorcheck = 1;
    } elseif (!is_numeric($phone)) {
        $phoneErr = "Please enter numeric only";
        $errorcheck = 1;
    } elseif (strlen($phone) != 10) {
        $phoneErr = "Enter 10 digit only";
        $errorcheck = 1;
    }

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

    // gender validation
    $gender = trim($_POST['gender']);
    if (empty($gender)) {
        $genderErr = "Please select your gender";
        $errorcheck = 1;
    }

    if ($errorcheck == 0) {
        $a = new Users();
        $a->insert('users', ['first_name' => $fname, 'last_name' => $lname, 'email' => $email, 'phone_number' => $phone, 'password' => md5($password), 'gender' => $gender, 'file' => $file, 'created_date' => $created_date, 'modified_date' => $modified_date]);
        $result = $a->sql;
        if ($result){
            // file moving in upload folder
            move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
        echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span>Data inserted successfully</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ';
    } else {
        echo mysqli_error($conn);
    }
}
}

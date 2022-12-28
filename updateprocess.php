<?php

require_once 'conn.php';

// define variables
$fname = $lname = $email = $phone = $password = $cpassword = $gender = $created_date = $modified_date = "";
$fnameErr = $lnameErr = $emailErr = $phoneErr = $passwordErr = $cpasswordErr = $genderErr = "";
$errorcheck = 1;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errorcheck = 0;
    $modified_date = date("l jS \of F Y h:i:s A");
    $email2 = trim($_POST['email2']);


    $b = new Users();
    $b->selectByEmail("users", "*", $email2);
    $result = $b->sql;

    $row = mysqli_fetch_assoc($result);
    $file2 = $row['file'];
    $id3 = $row['id'];


    // file validation
    $target_dir = "assets/images/";
    $file = $_FILES['file']['name'];
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    $allowed_image_extension = array("png", "jpg", "jpeg");

    // file validation
    if (empty($_FILES["file"]["name"])) {
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
        echo "Please enter your first name";
        $errorcheck = 1;
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $fname)) {
        echo "Please enter characters only";
        $errorcheck = 1;
    } else if (strlen($fname) < 3) {
        echo "Please enter at least 3 characters";
        $errorcheck = 1;
    }

    // last name validation
    $lname = trim($_POST['lname']);
    if (empty($lname)) {
        echo "Please enter your last name";
        $errorcheck = 1;
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $lname)) {
        echo "Please enter characters only";
        $errorcheck = 1;
    } else if (strlen($lname) < 3) {
        echo "Please enter at least 3 characters";
        $errorcheck = 1;
    }

    // email validation
    $email = trim($_POST['email']);
    $ee = new Users();
    $ee->emailExist('users', ['email' => $email]);
    $result = $ee->sql;
    $num = mysqli_num_rows($result);
    $num = mysqli_num_rows($result);
    if (empty($email)) {
        echo "Please enter your email";
        $errorcheck = 1;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Please enter valid email";
        $errorcheck = 1;
    } elseif ($email != $email2) {
        if ($num == 1) {
            echo "emailerror";
            $errorcheck = 1;
        }
    }


    // phone number validation
    $phone = trim($_POST['phone']);
    if (empty($phone)) {
        $phoneErr = "Please enter your phone number";
        echo "Please enter your phone number";
        $errorcheck = 1;
    } elseif (!is_numeric($phone)) {
        echo "Please enter numeric only";
        $errorcheck = 1;
    } elseif (strlen($phone) != 10) {
        echo "Enter 10 digit only";
        $errorcheck = 1;
    }

    // gender validation
    $gender = trim($_POST['gender']);
    if (empty($gender)) {
        echo "Please select your gender";
        $errorcheck = 1;
    }

    if ($errorcheck == 0) {

        if (!empty($file)) {
            move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
        } else {
            $file = $file2;
        }
        $r = new Users();
        $r->update('users', ['first_name' => $fname, 'last_name' => $lname, 'email' => $email, 'phone_number' => $phone, 'gender' => $gender, 'file' => $file, 'modified_date' => $modified_date], $id3);
        $result = $r->sql;
        if ($result) {
            if (isset($_SESSION['admin'])) {
                echo 'admin';
            } elseif (isset($_SESSION['client'])) {
                echo 'client';
            }
        } else {
            echo mysqli_error($conn);
        }
    }
}

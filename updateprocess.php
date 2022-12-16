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
    $sql = "SELECT * FROM `users` WHERE `email` = '$email2'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($result);
    // $fname = $row[1];
    // $lname = $row[2];
    // $email2 = $row[3];
    // $phone = $row[4];
    // $password = $row[5];
    // $gender = $row[6];
    $file2 = $row[7];


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
        // $fnameErr = "Please enter your first name";
        echo "Please enter your first name";
        $errorcheck = 1;
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $fname)) {
        // $fnameErr = "Please enter characters only";
        echo "Please enter characters only";
        $errorcheck = 1;
    } else if (strlen($fname) < 3) {
        // $fnameErr = "Please enter at least 3 characters";
        echo "Please enter at least 3 characters";
        $errorcheck = 1;
    }

    // last name validation
    $lname = trim($_POST['lname']);
    if (empty($lname)) {
        // $lnameErr = "Please enter your last name";
        echo "Please enter your last name";
        $errorcheck = 1;
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $lname)) {
        // $lnameErr = "Please enter characters only";
        echo "Please enter characters only";
        $errorcheck = 1;
    } else if (strlen($lname) < 3) {
        // $lnameErr = "Please enter at least 3 characters";
        echo "Please enter at least 3 characters";
        $errorcheck = 1;
    }

    // email validation
    $email = trim($_POST['email']);
    $sql = " SELECT * FROM `users` WHERE `email` = '$email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if (empty($email)) {
        // $emailErr = "Please enter your email";
        echo "Please enter your email";
        $errorcheck = 1;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // $emailErr = "Please enter valid email";
        echo "Please enter valid email";
        $errorcheck = 1;
    } elseif ($email != $email2) {
        if ($num == 1) {
            // $emailErr = "Email already exist";
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
        // $phoneErr = "Please enter numeric only";
        echo "Please enter numeric only";
        $errorcheck = 1;
    } elseif (strlen($phone) != 10) {
        // $phoneErr = "Enter 10 digit only";
        echo "Enter 10 digit only";
        $errorcheck = 1;
    }

    // password validation
    $password = trim($_POST['password']);
    if (empty($password)) {
        $passwordErr = "Please enter your password";
        echo "Please enter your password";
        $errorcheck = 1;
    }

    // confirm password validation
    $cpassword = trim($_POST['cpassword']);
    if (empty($cpassword)) {
        // $cpasswordErr = "Please enter your confirm password";
        echo "Please enter your confirm password";
        $errorcheck = 1;
    } elseif ($password != $cpassword) {
        // $cpasswordErr = "confirm password not matched with password";
        echo "confirm password not matched with password";
        $errorcheck = 1;
    }

    // gender validation
    $gender = trim($_POST['gender']);
    if (empty($gender)) {
        // $genderErr = "Please select your gender";
        echo "Please select your gender";
        $errorcheck = 1;
    }

    if ($errorcheck == 0) {

        // $sql = "INSERT INTO user (name, email, city) 
        if (!empty($file)) {
            move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
        } else {
            $file = $file2;
        }
        
        $sql = "UPDATE `users` SET `first_name` = '$fname', `last_name` = '$lname', `email` = '$email', `phone_number` = '$phone', `password` = '$password', `gender` = '$gender', `file` = '$file', `modified_date` = '$modified_date' where `email` = '$email2'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // header("location: users.php?success=1");
            // echo '<img src="' . $target_file . '" alt=""><br><br>';
            // echo "<p>First Name : ". $fname. "</p>";
            // echo "<p>Last Name : ". $lname. "</p>";
            // echo "<p>Email : ". $email. "</p>";
            // echo "<p>Phone Number : ". $phone. "</p>";
            // echo "<p>Gender : ". $gender. "</p>";
            // echo '
            // <div class="alert alert-success alert-dismissible fade show" role="alert">
            //     <span>Data updated successfully</span>
            //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            // </div>
            // ';
            if(isset($_SESSION['admin'])){
                echo 'admin';
            }elseif(isset($_SESSION['client'])){
                echo 'client';
            }
        } else {
            echo mysqli_error($conn);
        }
    }
}

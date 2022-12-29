<?php
require_once 'conn.php';
require_once 'validation.php';

// define variables
$fname = $lname = $email = $phone = $password = $cpassword = $gender = $created_date = $modified_date = "";
$fnameErr = $lnameErr = $emailErr = $phoneErr = $passwordErr = $cpasswordErr = $genderErr = "";
$errorcheck = 1;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = trim($_POST['password']);
    $cpassword = trim($_POST['cpassword']);
    $gender = trim($_POST['gender']);

    $obj = new validation();
    $obj->check($fname, $lname, $email, $phone, $password, $cpassword, $gender);
    $fnameErr = $obj->fnameErr;
    $lnameErr = $obj->lnameErr;
    $emailErr = $obj->emailErr;
    $phoneErr = $obj->phoneErr;
    $passwordErr = $obj->passwordErr;
    $cpasswordErr = $obj->cpasswordErr;
    $genderErr = $obj->genderErr;
    $errorcheck = $obj->errorcheck;

    // check email exist
    $ee = new Users();
    $ee->emailExist('users', ['email' => $email]);
    $result = $ee->sql;
    $num = mysqli_num_rows($result);
    if ($num == 1) {
        $emailErr = "Email already exist";
        echo "emailerror";
        $errorcheck = 1;
    }

   
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
        echo "error";
    }
}
}

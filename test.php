<?php
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
// echo $fnameErr ;
// echo $lnameErr ;
// echo $emailErr ;
// echo $phoneErr ;
// echo $passwordErr ;    
// echo $cpasswordErr ;
// echo $genderErr ;
// echo $errorcheck ;

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

// file validation
$target_dir = "assets/images/";
$file = $_FILES['file']['name'];
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$check = getimagesize($_FILES["file"]["tmp_name"]);
$allowed_image_extension = array("png", "jpg", "jpeg");

if (empty($_FILES["file"]["name"])) {
    $fileErr = 'Please select image';
    $errorcheck = 1;
} elseif ($_FILES["file"]["size"] > 50000) {
    $fileErr = 'Sorry, your file is greater than 50kb.';
    $errorcheck = 1;
} elseif (!in_array($imageFileType, $allowed_image_extension)) {
    $fileErr = 'Sorry, only JPG, JPEG & PNG files are allowed.';
    $errorcheck = 1;
}

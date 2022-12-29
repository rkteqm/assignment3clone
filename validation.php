<?php
class validation
{
    public $errorcheck;
    function check($fname, $lname, $email, $phone, $password, $cpassword, $gender)
    {
        $this->errorcheck = 0;

        if (empty($fname)) {
            $this->fnameErr = "Please enter your first name";
            $this->errorcheck = 1;
        } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $fname)) {
            $this->fnameErr = "Please enter characters only";
            $this->errorcheck = 1;
        } else if (strlen($fname) < 3) {
            $this->fnameErr = "Please enter at least 3 characters";
            $this->errorcheck = 1;
        }

        if (empty($lname)) {
            $this->lnameErr = "Please enter your first name";
            $this->errorcheck = 1;
        } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $lname)) {
            $this->lnameErr = "Please enter characters only";
            $this->errorcheck = 1;
        } else if (strlen($lname) < 3) {
            $this->lnameErr = "Please enter at least 3 characters";
            $this->errorcheck = 1;
        }

        if (empty($email)) {
            $this->emailErr = "Please enter your email";
            $this->errorcheck = 1;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->emailErr = "Please enter valid email";
            $this->errorcheck = 1;
        }

        if (empty($phone)) {
            $this->phoneErr = "Please enter your phone number";
            $this->errorcheck = 1;
        } elseif (!is_numeric($phone)) {
            $this->phoneErr = "Please enter numeric only";
            $this->errorcheck = 1;
        } elseif (strlen($phone) != 10) {
            $this->phoneErr = "Enter 10 digit only";
            $this->errorcheck = 1;
        }

        if (empty($password)) {
            $this->passwordErr = "Please enter your password";
            $this->errorcheck = 1;
        }

        $cpassword = trim($_POST['cpassword']);
        if (empty($cpassword)) {
            $this->cpasswordErr = "Please enter your confirm password";
            $this->errorcheck = 1;
        } elseif ($password != $cpassword) {
            $this->cpasswordErr = "confirm password not matched with password";
            $this->errorcheck = 1;
        }

        if (empty($gender)) {
            $this->genderErr = "Please select your gender";
            $this->errorcheck = 1;
        }

    }
}

$(document).ready(function () {

    $('#form').submit(function (e) {

        errorcheck = 0;

        // Error removing if input is correct/valid
        var removeErr = document.getElementsByClassName('error');
        for (i = 0; i < removeErr.length; i++) {
            removeErr[i].innerHTML = "";
        }

        var letters = /^[A-Za-z\s]+$/;
        var validRegex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

        var fname = $("#fname").val();
        fname = fname.trim();
        var lname = $("#lname").val();
        lname = lname.trim();
        var email = $("#email").val();
        email = email.trim();
        var email2 = $("#email2").val();
        email2 = email2.trim();
        var phone = $("#phone").val();
        phone = phone.trim();
        var gender = "";
        var ele = document.getElementsByName('gender');
        for (i = 0; i < ele.length; i++) {
            if (ele[i].checked) {
                gender = ele[i].value;
            }
        }

        // file validation
        var fileInput = $('#file');
        var fileToUpload = fileInput.val();
        var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

        var mysubmit = "";
        mysubmit = $("#mysubmit").val();
        mysubmit = mysubmit.trim();
        if (mysubmit != "") {
            if (fileToUpload == "") {
                $('#fileErr').html("Please select image");
                errorcheck = 1;
            } else if (!allowedExtensions.exec(fileToUpload)) {
                $('#fileErr').html("Sorry, only JPG, JPEG & PNG files are allowed.");
                errorcheck = 1;
            } else if ($('#file')[0].files[0].size > 50000) {
                $('#fileErr').html("Sorry, your file is greater than 50kb.");
                errorcheck = 1;
            }
            var password = $("#password").val();
            password = password.trim();
            var cpassword = $("#cpassword").val();
            cpassword = cpassword.trim();
            // password validation
            if (password == "") {
                $('#passwordErr').html("Please enter your password");
                errorcheck = 1;
            }

            // confirm password validation
            if (cpassword == "") {
                $('#cpasswordErr').html("Please enter your confirm password");
                errorcheck = 1;
            } else if (cpassword != password) {
                $('#cpasswordErr').html("confirm password not matched with password");
                errorcheck = 1;
            }

        } else {
            if (fileToUpload == "") {

            } else if (!allowedExtensions.exec(fileToUpload)) {
                $('#fileErr').html("Sorry, only JPG, JPEG & PNG files are allowed.");
                errorcheck = 1;
            } else if ($('#file')[0].files[0].size > 50000) {
                $('#fileErr').html("Sorry, your file is greater than 50kb.");
                errorcheck = 1;
            }
        }

        // first name validation
        if (fname == "") {
            $('#fnameErr').html("Please enter your first name");
            errorcheck = 1;
        } else if (!fname.match(letters)) {
            $('#fnameErr').html("Please enter characters only");
            errorcheck = 1;
        } else if (fname.length < 3) {
            $('#fnameErr').html("Please enter at least 3 characters");
            errorcheck = 1;
        }

        // last name validation
        if (lname == "") {
            $('#lnameErr').html("Please enter your last name");
            errorcheck = 1;
        } else if (!lname.match(letters)) {
            $('#lnameErr').html("Please enter characters only");
            errorcheck = 1;
        } else if (lname.length < 3) {
            $('#lnameErr').html("Please enter at least 3 characters");
            errorcheck = 1;
        }

        // email validation
        if (email == null || email == "") {
            $('#emailErr').html("Please enter your email");
            errorcheck = 1;
        } else if (!email.match(validRegex)) {
            $('#emailErr').html("Please enter valid email");
            errorcheck = 1;
        }

        // phone number validation
        if (phone == "") {
            $('#phoneErr').html("Please enter your phone number");
            errorcheck = 1;
        } else if (isNaN(phone)) {
            $('#phoneErr').html("Please enter numeric only");
            errorcheck = 1;
        } else if (phone.length != 10) {
            $('#phoneErr').html("please enter 10 digit only");
            errorcheck = 1;
        }

        // gender validation
        if (gender == "") {
            $('#genderErr').html("Please select your gender");
            errorcheck = 1;
        }

        if (errorcheck == 0) {

            // ******************for normal form submission************************
            // e.preventDefault();
            // $.ajax({
            //     url: 'registerprocess.php',
            //     type: 'POST',
            //     data: $(this).serialize(),
            //     success: function (data) {
            //         if (data == "emailerror") {
            //             $('#emailErr').html("Email already exist");
            //         } else {
            //             window.location.href = "login.php";
            //         }
            //     }
            // });

            // ********************for file submission****************************
            e.preventDefault();

            var formData = new FormData();
            formData.append('file', $('#file')[0].files[0]);
            formData.append('fname', fname);
            formData.append('lname', lname);
            formData.append('email', email);
            formData.append('phone', phone);
            formData.append('gender', gender);

            if (mysubmit != "") {
                formData.append('password', password);
                formData.append('cpassword', cpassword);
                $.ajax({
                    url: 'registerprocess.php',
                    type: 'POST',
                    data: formData,
                    processData: false, // tell jQuery not to process the data
                    contentType: false, // tell jQuery not to set contentType
                    success: function (data) {
                        // $('.test').html('');
                        // $('.test').append(data);
                        // myreset();
                        if (data == "emailerror") {
                            $('#emailErr').html("Email already exist");
                        } else {
                            window.location.href = "login.php";
                        }
                    }
                });
            } else {
                if (fileToUpload == "") {
                    $.ajax({
                        url: 'updateprocess.php',
                        type: 'POST',
                        data: $('#form').serialize(),
                        success: function (data) {
                            if (data == "emailerror") {
                                $('#emailErr').html("Email already exist");
                            } else if (data == "admin") {
                                window.location.href = "users.php";
                            } else if (data == "client") {
                                window.location.href = "client.php";
                            }
                        }
                    });
                } else {
                    formData.append('email2', email2);
                    $.ajax({
                        url: 'updateprocess.php',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            // $('.testupdate').html('');
                            // $('.testupdate').append(data);
                            if (data == "emailerror") {
                                $('#emailErr').html("Email already exist");
                            } else if (data == "admin") {
                                window.location.href = "users.php";
                            } else if (data == "client") {
                                window.location.href = "client.php";
                            }
                        }
                    });

                }
            }
            // return false
        } else {
            return false;
        }
    });

    // error removing on keyup
    $('input[name=file]').click(function () {
        $('#fileErr').html("");
    });
    $('input[name=fname]').keyup(function () {
        $('#fnameErr').html("");
    });
    $('input[name=lname]').keyup(function () {
        $('#lnameErr').html("");
    });
    $('input[name=email]').keyup(function () {
        $('#emailErr').html("");
    });
    $('input[name=phone]').keyup(function () {
        $('#phoneErr').html("");
    });
    $('input[name=password]').keyup(function () {
        $('#passwordErr').html("");
    });
    $('input[name=cpassword]').keyup(function () {
        $('#cpasswordErr').html("");
    });
    $('input[name=gender]').click(function () {
        $('#genderErr').html("");
    });

    // show hide password
    $('#showpassword').click(function () {
        var type = $('#password').attr('type');
        if (type == 'password') {
            $('#password').attr('type', 'text');
        } else {
            $('#password').attr('type', 'password');
        }
        return false;
    });

    $('#showcpassword').click(function () {
        var type = $('#cpassword').attr('type');
        if (type == 'password') {
            $('#cpassword').attr('type', 'text');
        } else {
            $('#cpassword').attr('type', 'password');
        }
        return false;
    });

    // for remove user
    $('.remove').on('click', function (e) {
        var a = e.target.value;
        var b = $(this).parents("tr:first");
        var result = confirm("Are you sure to delete?");
        if (result) {
            $.ajax({
                type: 'POST',
                url: 'delete.php',
                data: {
                    remove: true,
                    id: a
                },
                success: function (data) {
                    if (data == "client") {
                        window.location.href = "index.php?ads=1";
                    } else {
                        b.hide();
                        $('.removesuccess').html();
                        $('.removesuccess').html(data);
                    }
                }
            });
        } else {
            return false;
        }
    });

    $('.forgot').click(function () {
        alert('sssss');
    });

});
// <!-- script for delete confirmation -->
function confirmation() {
    var result = confirm("Are you sure to delete?");
    if (!result) {
        return false;
    }
}



// function myreset() {
//     var removeinput = document.getElementsByClassName('form-control');
//     for (i = 0; i < removeinput.length; i++) {
//         removeinput[i].value = "";
//     }
// }
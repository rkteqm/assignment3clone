$(document).ready(function() {
    var validRegex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    $('#login').click(function() {
      var errorcheck = 0;
      // email validation
      email = $('#email').val();
      email = email.trim();
      if (email == "") {
        $('#emailErr').html("Please enter your email");
        errorcheck = 1;
      } else if (!email.match(validRegex)) {
        $('#emailErr').html("Please enter valid email");
        errorcheck = 1;
      } else {
        $('#emailErr').html("");
      }
      // password validation
      password = $('#password').val();
      password = password.trim();
      if (password == null || password == "") {
        $('#passwordErr').html("Please enter your password");
        errorcheck = 1;
      } else {
        $('#passwordErr').html("");
      }
      if (errorcheck == 0) {
        return true;
      } else {
        return false
      }
    });
    $('#fp').click(function(){
      email = $('#email').val();
      email = email.trim();
      $('#emailf').val(email);
    });
    $('#forgot').click(function() {
      errorcheck = 0;
      email = $('#emailf').val();
      email = email.trim();
      if (email == "") {
        $('#emailErrf').html("Please enter your email");
        errorcheck = 1;
      } else if (!email.match(validRegex)) {
        $('#emailErrf').html("Please enter valid email");
        errorcheck = 1;
      } else {
        $('#emailErrf').html("");
      }
      if (errorcheck == 0) {
        $.ajax({
          url: 'forgot.php',
          type: 'post',
          data: ({
            email: email
          }),
          success: function(respone) {

            if (respone == 0) {
              $('#emailErrf').html("Your email is not register");
            } else {
              id = respone;
              $("body").css({
                "background-image": "url('loader.gif')",
                "background-repeat": "no-repeat",
                "background-attachment": "fixed",
                "background-position": "center"
              });
              sendMail(id, email);
              iresetid(id);
            }
          }
        });
        // alert(email);
        return false;
      }else{
        return false;
      }
    });

  });

  function sendMail(id, email) {
    $.ajax({
      url: 'indexmail.php',
      type: 'post',
      data: ({
        id: id,
        email: email
      }),
      success: function(respone) {
        $("body").css({
          "background-image": "url()"
        });
        $('#forgot-back-btn').trigger('click');
        $('#resetmessage').show();
      }
    });
  }
  function iresetid(id) {
    $.ajax({
      url: 'insertresetid.php',
      type: 'post',
      data: ({
        id: id
      }),
      success: function(respone) {
      }
    });
  }
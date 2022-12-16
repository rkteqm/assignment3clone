<script>
    e.preventDefault();

    var formData = new FormData();
    formData.append('file', $('#file')[0].files[0]);
    formData.append('fname', $('#fname').val());
    formData.append('lname', $('#lname').val());
    formData.append('email', $('#email').val());
    formData.append('phone', $('#phone').val());
    formData.append('password', $('#password').val());
    formData.append('cpassword', $('#cpassword').val());
    formData.append('gender', $('#gender').val());
    $.ajax({
        url: 'registerprocess.php',
        type: 'POST',
        data: $(this).serialize(),
        success: function(data) {
            $('.test').html('');
            $('.test').append(data);
            $('#hideAfterFormSubmit').hide();
            $('#mydata').show();
        }
    });
</script>
$('#form').submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: 'ajax.php',
        type: 'POST',
        data: $(this).serialize(),
        success: function (data) {
            $('.test').html('');
            $('.test').append(data);
            $('#hideAfterFormSubmit').hide();
            $('#mydata').show();
        }
    });
});
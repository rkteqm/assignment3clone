<?php
require_once 'conn.php';
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>
    <script src="./assets/js/script.js"></script>
</head>

<body>
    <!----------------------------------- navbar -------------------------------------->
    <?php
    require_once 'navbar.php';
    ?>
    <span class="removesuccess"></span>
    <!----------------------------------- users table -------------------------------------->
    <div class="container mt-3">
        <div class="row">
            <table id="mytable" class="display" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th></th>
                        <th>Email</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone Number</th>
                        <th>Image</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <script>
        jQuery(document).ready(function() {
            var i = 1;
            var table = jQuery('#mytable').dataTable({
                "bProcessing": true,
                "sAjaxSource": "pagination_data.php",
                "bPaginate": true,
                "sPaginationType": "full_numbers",
                "iDisplayLength": 10,
                "bLengthChange": true,
                "bFilter": true,
                "aoColumns": [
                    {
                        "render": function(data, type, full, meta) {
                            return i++;
                        }
                    },
                    {
                        mData: 'email'
                    },
                    {
                        mData: 'first_name'
                    },
                    {
                        mData: 'last_name'
                    },
                    {
                        mData: 'phone_number'
                    },
                    {
                        mData: 'file',
                        "render": function(mData) {
                            return '<img src="assets/images/' + mData + '" width="60px">';
                        }
                    },
                    { mData: "id",
                        "orderable": false,
                        "searchable": false,
                        "render": function(mData,type,row,meta) { // render event defines the markup of the cell text 
                            var a = '<td><a href="view.php?id=' + row.id + '">View</a></td>'; // row object contains the row data
                            return a;
                        }
                    }
                ]
            });
        });
    </script>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>
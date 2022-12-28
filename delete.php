<?php

require_once 'conn.php';
if (isset($_SESSION['id']) && isset($_GET['id'])) {
    $id = $_REQUEST['id'];
    $d = new Users();
    $d->delete('users', $id);
    $result = $d->sql;
    
    if ($result) {
        if(isset($_SESSION['admin'])){
            header("location: users.php?deletesuccess=1");
        }elseif(isset($_SESSION['client'])){
            header("location: client.php?deletesuccess=1");
        }
    }
} else if (isset($_POST['remove'])) {
    $id = $_POST['id'];
    $sql = "UPDATE `users` SET `soft_delete` = '0' WHERE `id` = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        if(isset($_SESSION['admin'])){
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span>Data deleted successfully</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ';
        }elseif(isset($_SESSION['client'])){
            echo 'client';
        }
    }
} else {
    header("location: login.php");
}

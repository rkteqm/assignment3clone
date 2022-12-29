<?php
session_start();
if(isset($_SESSION['id'])){
    session_unset();
    session_destroy();
    header('location: login.php');
}elseif(isset($_SESSION['rid'])){
    session_unset();
    session_destroy();
    header('location: login.php?reset=1');
}else{
    header("location: login.php");
}

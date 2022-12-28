<?php
require_once 'conn.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];
    $a = new Users();
    $a->insertResetId('reset', ['reset_id' => $id]);
    $result = $a->sql;
    if($result){
        echo "reset id inserted";
    }
}
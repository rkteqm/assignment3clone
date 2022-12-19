<?php
include_once("conn.php");
// $sql = "SELECT id, email, first_name, last_name, file, phone_number FROM users LIMIT 20";
$sql = "SELECT id, email, first_name, last_name, file, phone_number FROM users";
$resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
$data = array();
while ($rows = mysqli_fetch_assoc($resultset)) {
    $data[] = $rows;
}
$results = array(
    "sEcho" => 1,
    "iTotalRecords" => count($data),
    "iTotalDisplayRecords" => count($data),
    "aaData" => $data
);
echo json_encode($results);
exit;

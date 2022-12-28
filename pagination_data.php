<?php
include_once("conn.php");
$b = new Users();
$b->select("users","*");
$result = $b->sql;
$data = array();
while ($rows = mysqli_fetch_assoc($result)) {
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

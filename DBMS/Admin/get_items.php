<?php
include 'connection.php';

$sql = "SELECT * FROM items";
$result = mysqli_query($conn, $sql);

$rows = array();

if($result){
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
}

header("Content-Type: application/json");
echo json_encode($rows);

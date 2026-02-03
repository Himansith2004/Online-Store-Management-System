<?php

header("Content-Type: application/json");

$db_server = "localhost";
$db_user="root";
$db_pass="";
$db_name="onlinestoremanagement";

$conn=mysqli_connect($db_server,$db_user,$db_pass,$db_name);
if($conn->connect_error){
    echo json_encode(["error => DB connection failed"]);
    exit;
}

$sql = "SELECT ItemID,ItemName,ItemPrice,ItemDiscount,ItemStockQuantity,ItemImage FROM items";
$results = $conn->query($sql);

$data = [];

while ($row = $results->fetch_assoc()){
    $data[] = $row;
}

echo json_encode($data);
$conn->close();

?>
<?php
include 'connection.php';

$data = json_decode(file_get_contents("php://input"), true);

$supplierid = $data['supplierid'];
$itemname   = $data['name'];
$price      = $data['price'];
$discount   = $data['discount'];
$stock      = $data['stock'];

$sql = "INSERT INTO item (SupplierID, ItemName, Price, Discount, StockQuantity)
        VALUES ('$supplierid','$itemname','$price','$discount','$stock')";

if(mysqli_query($conn, $sql)){
    echo "OK";
}else{
    echo "DB Error: " . mysqli_error($conn);
}
?>

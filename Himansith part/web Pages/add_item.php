<?php
include 'connection.php';

$supplierid = $_POST['supplierid'];
$itemname   = $_POST['name'];
$price      = $_POST['price'];
$discount   = $_POST['discount'];
$stock      = $_POST['stock'];

$sql = "INSERT INTO item (SupplierID, ItemName, Price, Discount, StockQuantity)
        VALUES ('$supplierid', '$itemname', '$price', '$discount', '$stock')";

if(mysqli_query($conn, $sql)){
    echo "OK";
}else{
    echo "DB Error: " . mysqli_error($conn);
}
?>

<?php
include 'connection.php';

$loginid = $_POST['loginid'];
$name    = $_POST['name'];
$phone   = $_POST['phone'];
$address = $_POST['address'];

$sql = "INSERT INTO supplier (LoginID, SupplierName, PhoneNumber, Address)
        VALUES ('$loginid', '$name', '$phone', '$address')";

if(mysqli_query($conn, $sql)){
    echo "OK";
}else{
    echo "DB Error: " . mysqli_error($conn);
}
?>

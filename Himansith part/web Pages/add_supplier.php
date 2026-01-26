<?php
include 'connection.php';

$data = json_decode(file_get_contents("php://input"), true);

$loginid = $data['loginid'];
$name    = $data['name'];
$phone   = $data['phone'];
$address = $data['address'];

$sql = "INSERT INTO supplier (LoginID, SupplierName, PhoneNumber, Address)
        VALUES ('$loginid','$name','$phone','$address')";

if(mysqli_query($conn, $sql)){
    echo "OK";
}else{
    echo "DB Error: " . mysqli_error($conn);
}
?>

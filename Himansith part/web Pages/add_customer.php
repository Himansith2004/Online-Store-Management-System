<?php
include 'connection.php';

$data = json_decode(file_get_contents("php://input"), true);

$loginid = $data['loginid'];
$fname   = $data['fname'];
$lname   = $data['lname'];
$phone   = $data['phone'];
$address = $data['address'];
$email   = $data['email'];
$password= $data['password'];

$sql = "INSERT INTO customer (LoginID, FirstName, LastName, PhoneNumber, Address, Email, Password)
        VALUES ('$loginid','$fname','$lname','$phone','$address','$email','$password')";

if(mysqli_query($conn, $sql)){
    echo "OK";
}else{
    echo "DB Error: " . mysqli_error($conn);
}
?>

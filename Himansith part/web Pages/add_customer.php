<?php
include 'connection.php';

$loginid = $_POST['loginid'];
$fname   = $_POST['fname'];
$lname   = $_POST['lname'];
$phone   = $_POST['phone'];
$address = $_POST['address'];
$email   = $_POST['email'];
$password= $_POST['password'];

$sql = "INSERT INTO customer (LoginID, FirstName, LastName, PhoneNumber, Address, Email, Password)
        VALUES ('$loginid','$fname','$lname','$phone','$address','$email','$password')";

if(mysqli_query($conn, $sql)){
    echo "OK";
}else{
    echo "DB Error: " . mysqli_error($conn);
}
?>

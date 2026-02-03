<?php
include 'connection.php';

$name    = $_POST['name'];
$phone   = $_POST['phone'];
$address = $_POST['address'];
$email   = $_POST['email'];
$password= $_POST['password'];

$stmt = $conn ->prepare("INSERT INTO login (Email,Password,UserRole) VALUES (?,?,?)");
$role = 'Supplier';
$stmt->bind_param("sss", $email,$password,$role);
$stmt -> execute();
$login = $conn -> insert_id;
$stmt-> close();

$stmt = $conn ->prepare("INSERT INTO supplier (LoginID,SupplierName,SupplierPhoneNumber,SupplierAddress)
        VALUES (?,?,?,?)");
$stmt->bind_param("isss",$login,$name,$phone,$address);

$stmt->execute();


$stmt->close();
$conn->close();
?>


<?php
include "connection.php";
$sql = "UPDATE customer SET LoginID=?, FirstName=?, LastName=?, PhoneNumber=?, Address=?, Email=? WHERE CustomerID=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssi", $_POST['loginid'], $_POST['fname'], $_POST['lname'], $_POST['phone'], $_POST['address'], $_POST['email'], $_POST['id']);
echo $stmt->execute() ? "Customer Updated" : "Error";
?>

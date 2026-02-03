<?php
include "connection.php";
$sql1 = "UPDATE supplier SET LoginID=?, SupplierName=?, SupplierPhoneNumber=?, SupplierAddress=? WHERE SupplierID=?";
$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param("isssi", $_POST['loginid'], $_POST['name'], $_POST['phone'], $_POST['address'], $_POST['id']);
$stmt1->execute();

$sql2 = "UPDATE login SET Email = ? WHERE LoginID=?";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("si",$_POST['email'],$_POST['loginid']);
$stmt2->execute();

?>

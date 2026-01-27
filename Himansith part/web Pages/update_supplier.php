<?php
include "connection.php";
$sql = "UPDATE supplier SET LoginID=?, SupplierName=?, PhoneNumber=?, Address=? WHERE SupplierID=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $_POST['loginid'], $_POST['name'], $_POST['phone'], $_POST['address'], $_POST['id']);
echo $stmt->execute() ? "Supplier Updated" : "Error";
?>

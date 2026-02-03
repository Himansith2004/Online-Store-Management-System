<?php
include "connection.php";
$id = $_POST['id'];

$sql = "SELECT l.LoginID FROM supplier s
        JOIN login l ON s.LoginID = l.LoginID
        WHERE s.SupplierID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i",$id);
$stmt->execute();
$stmt->bind_result($loginID);
$stmt->fetch();
$stmt->close();

$conn->query("DELETE FROM items WHERE SupplierID=$id");
$conn->query("DELETE FROM supplier WHERE SupplierID=$id");
$conn->query("DELETE FROM login WHERE LoginID=$loginID");
echo "Supplier Deleted";
?>

<?php
include "connection.php";
$id = $_POST['id'];
$conn->query("DELETE FROM supplier WHERE SupplierID=$id");
echo "Supplier Deleted";
?>

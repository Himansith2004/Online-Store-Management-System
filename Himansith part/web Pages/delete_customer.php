<?php
include "connection.php";
$id = $_POST['id'];
$conn->query("DELETE FROM customer WHERE CustomerID=$id");
echo "Customer Deleted";
?>

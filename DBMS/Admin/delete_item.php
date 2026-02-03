<?php
include "connection.php";
$id = $_POST['id'];
$conn->query("DELETE FROM items WHERE ItemID=$id");
echo "Item Deleted";
?>

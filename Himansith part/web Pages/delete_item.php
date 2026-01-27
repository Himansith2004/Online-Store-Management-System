<?php
include "connection.php";
$id = $_POST['id'];
$conn->query("DELETE FROM item WHERE ItemID=$id");
echo "Item Deleted";
?>

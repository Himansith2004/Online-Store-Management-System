<?php
include "connection.php";
$sql = "UPDATE items SET SupplierID=?, ItemName=?, ItemPrice=?, ItemDiscount=?, ItemStockQuantity=? WHERE ItemID=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isddii", $_POST['supplierid'], $_POST['name'], $_POST['price'], $_POST['discount'], $_POST['stock'], $_POST['id']);
echo $stmt->execute() ? "Item Updated" : "Error";
?>

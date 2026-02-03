<?php
session_start();
header("Content-Type: application/json");

include 'C:\Users\Gowthaman\OneDrive\Desktop\XAMPP\htdocs\DBMS\Admin\connection.php';

$loginID = $_SESSION['loginid'];

$sql = "SELECT ItemID,ItemName,ItemPrice,ItemDiscount,ItemStockQuantity,ItemImage FROM items";
$results = $conn->query($sql);

$data = [];

while ($row = $results->fetch_assoc()){
    $row['login_id'] = $loginID;
    $data[] = $row;
}

echo json_encode($data);
$conn->close();

?>
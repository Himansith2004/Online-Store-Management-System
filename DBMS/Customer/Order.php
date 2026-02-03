<?php

session_start();

include 'C:\Users\Gowthaman\OneDrive\Desktop\XAMPP\htdocs\DBMS\Admin\connection.php';

if(!isset($_SESSION['loginid'])){
    exit("Please login first");
}

$loginID = $_SESSION['loginid'];
$item_id =  intval($_POST['item_id']);

$sql = "SELECT CustomerID FROM customer WHERE LoginID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i",$loginID);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows === 0) {
    exit("Customer not found");

}

$customer = $result->fetch_assoc();
$customer_id = $customer['CustomerID'];

$sql = "SELECT ItemPrice, ItemDiscount FROM items WHERE ItemID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $item_id);
$stmt->execute();
$result = $stmt->get_result();

$item = $result->fetch_assoc();
$totalAmount = $item['ItemPrice'] - $item['ItemDiscount'];

$sql = "INSERT INTO orders (ItemID, CustomerID, TotalAmount)
        VALUES (?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iid", $item_id, $customer_id, $totalAmount);
$stmt->execute();

$order_id = $stmt->insert_id;
$_SESSION['order_id'] = $order_id;
echo "Order placed successfully";

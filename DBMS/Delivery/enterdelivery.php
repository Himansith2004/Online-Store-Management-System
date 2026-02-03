<?php
session_start();
include 'C:\Users\Gowthaman\OneDrive\Desktop\XAMPP\htdocs\DBMS\Admin\connection.php';

$orderid = intval($_POST['order_id']);
$address = $_POST['address'];
$deliverymethod = $_POST['deliverymethod'];
$deliverytype = $_POST['deliverytype'];
$deliverystatus = "Still Not Delivered";

$sql = "INSERT INTO deliveries (OrderID, DeliveryLocation, DeliveryMethod, DeliveryType,DeliveryStatus)
        VALUES (?, ?, ?, ?,?)";


$stmt = $conn->prepare($sql);
$stmt->bind_param("issss", $orderid, $address, $deliverymethod, $deliverytype,$deliverystatus);
$stmt->execute();

$_SESSION['order_id'] = $orderid;
header("Location: http://localhost/DBMS/Payments/PaymentUI.php");
exit();


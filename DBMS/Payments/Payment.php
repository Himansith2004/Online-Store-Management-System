<?php
session_start();
include 'C:\Users\Gowthaman\OneDrive\Desktop\XAMPP\htdocs\DBMS\Admin\connection.php';

$orderid = intval($_POST['orderid']);  
$Paymentmethod = $_POST['paymentmethod'];

 $stmt = $conn->prepare("SELECT TotalAmount , CustomerID FROM orders WHERE OrderID = ?");
 $stmt->bind_param("i",$orderid);
 $stmt->execute();

 $result = $stmt->get_result();
 if($result->num_rows === 1){
        $row = $result->fetch_assoc();
        $TotalAmount= $row['TotalAmount'];
        $CustomerID= $row['CustomerID'];
}   else {
        die("Order not found.");
}
 $stmt->close();

 

$stmt = $conn->prepare("INSERT INTO payments (CustomerID, PaymentMethod, PaymentAmount) VALUES (?, ?, ?)");
$stmt->bind_param("isd", $CustomerID, $Paymentmethod, $TotalAmount);
$stmt->execute();
$stmt->close();

 echo "
    <script>
        alert('Thanks for your purchase!');
        window.location.href = 'http://localhost/DBMS/Customer/CustomerUI.html';
    </script>
    ";
    exit();

 
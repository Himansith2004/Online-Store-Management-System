<?php
include 'connection.php';

$supplierid = $_POST['supplierid'];
$itemname   = $_POST['name'];
$price      = $_POST['price'];
$discount   = $_POST['discount'];
$stock      = $_POST['stock'];

$stmt = $conn ->prepare("INSERT INTO items (SupplierID, ItemName, ItemPrice, ItemDiscount, ItemStockQuantity)
        VALUES(?,?,?,?,?)");
        
$stmt->bind_param('isiii',$supplierid,$itemname,$price,$discount,$stock);

if($stmt->execute()){
    echo "OK";
}else{
    echo "DB Error: " . mysqli_error($conn);
}

$stmt->close();
$conn->close();
?>

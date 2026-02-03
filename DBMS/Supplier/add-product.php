<?php
session_start();

$db_server = "localhost";
$db_user="root";
$db_pass="";
$db_name="onlinestoremanagement";

$conn=mysqli_connect($db_server,$db_user,$db_pass,$db_name);
if($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
}
else{

if(!isset($_SESSION['loginid'])){
    header("Location: http://localhost/DBMS/LoginForm/loginform.html");
    exit();
}

$loginID = $_SESSION['loginid'];

    $stmt = $conn->prepare("SELECT SupplierID FROM supplier WHERE LoginID = ?");
    $stmt->bind_param("i",$loginID);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows === 1){
        $supplier = $result->fetch_assoc();
        $SupplierID = $supplier['SupplierID'];
}   else {
        die("Supplier not found.");
}
    $stmt->close();

    $productname = $_POST['productname'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];
    $stock = $_POST['stock'];
    $image = $_POST['image'];
    $category = $_POST['category'];

    $stmt = $conn->prepare("INSERT INTO items
    (SupplierID, ItemName, ItemPrice, ItemDiscount, ItemStockQuantity,ItemImage)
    VALUES
    (?,?, ?, ?, ?,?)");
    $stmt->bind_param("isiiis",$SupplierID,$productname,$price,$discount,$stock,$image);
    $stmt -> execute();
    $ItemID= $conn -> insert_id;
    $stmt->close();

     $stmt = $conn->prepare("INSERT INTO item_category
    (ItemID,Category)
    VALUES
    (?,?)");
    $stmt->bind_param("is",$ItemID,$category);
    $stmt -> execute();
    $conn->close();

     header("Location: http://localhost/DBMS/Supplier/SupplierUI.php");
    exit();
    
}

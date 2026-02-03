<?php
include 'connection.php';

$sql = "SELECT s.SupplierID,s.LoginID,s.SupplierName,
               s.SupplierPhoneNumber,s.SupplierAddress,
               l.Email,l.Password

FROM supplier s
JOIN login l ON s.LoginID = l.LoginID";
$result = mysqli_query($conn, $sql);

$rows = array();

if($result){
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
}

header("Content-Type: application/json");
echo json_encode($rows);


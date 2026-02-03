<?php
include "connection.php";
$sql1 = "UPDATE customer SET LoginID =? , CustomerFname=?, CustomerPhoneNumber=?, CustomerAddress=? WHERE CustomerID=?";
$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param("isssi",$_POST['loginid'], $_POST['fname'], $_POST['phone'], $_POST['address'],$_POST['id']);
$stmt1->execute();

$sql2 = "UPDATE login SET Email = ? WHERE LoginID=?";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("si",$_POST['email'],$_POST['loginid']);
$stmt2->execute();

?>

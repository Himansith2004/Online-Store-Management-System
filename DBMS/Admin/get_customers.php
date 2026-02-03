<?php
header("Content-Type: application/json");
include 'connection.php';

$sql = "SELECT c.CustomerID,c.LoginID,c.CustomerFname,
               c.CustomerPhoneNumber,c.CustomerAddress,
               l.Email,l.Password

FROM customer c
JOIN login l ON c.LoginID = l.LoginID";

$result = mysqli_query($conn, $sql);

$rows = array();

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
}

echo json_encode($rows);
?>

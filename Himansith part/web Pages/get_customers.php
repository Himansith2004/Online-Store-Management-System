<?php
include 'connection.php';

$sql = "SELECT * FROM customer";
$result = mysqli_query($conn, $sql);

$rows = array();

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
}

echo json_encode($rows);
?>

<?php

$db_server = "localhost";
$db_user="root";
$db_pass="";
$db_name="onlinestoremanagement";

    $fname = $_POST['fname'];
    $lname = $_POST["lname"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

$conn=mysqli_connect($db_server,$db_user,$db_pass,$db_name);
if($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
}
else{
    $stmt = $conn ->prepare("INSERT INTO login (Email, Password,UserRole) VALUES (?,?,?)");
    $password ='pass123';
    $role = 'Customer';
    $stmt->bind_param("sss", $email,$password,$role);
    $stmt -> execute();

    $login = $conn -> insert_id;
    $stmt-> close();

    $stmt = $conn->prepare("INSERT INTO customer
    (LoginID, CustomerFname, CustomerLname, CustomerPhoneNumber, CustomerAddress, Email)
    VALUES
    (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $login,$fname,$lname,$phone,$address,$email);
    $stmt -> execute();
    echo "Registration Successfull..";
    $stmt->close();
    $conn->close();
}


?>

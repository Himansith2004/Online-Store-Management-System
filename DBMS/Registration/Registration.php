<?php

$db_server = "localhost";
$db_user="root";
$db_pass="";
$db_name="onlinestoremanagement";

    $role = $_POST['role'];
    $fname = $_POST['fname'];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    

$conn=mysqli_connect($db_server,$db_user,$db_pass,$db_name);
if($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
}
else{
    $stmt = $conn ->prepare("INSERT INTO login (Email, Password,UserRole) VALUES (?,?,?)");
    $stmt->bind_param("sss", $email,$password,$role);
    $stmt -> execute();
    $login = $conn -> insert_id;
    $stmt-> close();

    if($role === 'customer'){

    $stmt = $conn->prepare("INSERT INTO customer
    (LoginID, CustomerFname,CustomerPhoneNumber, CustomerAddress)
    VALUES
    (?, ?, ?, ?)");
    $stmt->bind_param("isss", $login,$fname,$phone,$address);
    $stmt -> execute();
    $stmt->close();

header("Location: http://localhost/DBMS/LoginForm/loginform.html");
    exit();
}
    if($role === 'supplier'){  
    $stmt = $conn->prepare("INSERT INTO supplier
    (LoginID, SupplierName, SupplierPhoneNumber, SupplierAddress)
    VALUES
    (?, ?, ?, ?)");
    $stmt->bind_param("isss", $login,$fname,$phone,$address);
    $stmt -> execute();
    $stmt->close();

    header("Location: http://localhost/DBMS/LoginForm/loginform.html");
    exit();
    }
}
?>

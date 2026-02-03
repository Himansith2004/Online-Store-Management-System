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

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $conn-> prepare("SELECT LoginID,Password,UserRole
                            FROM login
                            WHERE Email = ?");
$stmt->bind_param("s",$email);
$stmt->execute();

$results = $stmt->get_result();
if($results->num_rows === 0){
    echo "Invalid email or password !";
    exit();
}
    $user = $results->fetch_assoc();

    $_SESSION['loginid'] = $user['LoginID'];
    $_SESSION['role'] = $user['UserRole'];

    if($user['UserRole'] === 'Customer'){
        $stmt = $conn-> prepare("SELECT CustomerFName
        FROM customer
        WHERE LoginID = ?");
    

    $stmt->bind_param("i",$user['LoginID']);
    $stmt->execute();
    $cust = $stmt->get_result()->fetch_assoc();

    header("Location: http://localhost/DBMS/Customer/CustomerUI.html");
    exit();
    }

else if ($user['UserRole'] === 'Supplier') {

    $stmt = $conn->prepare(
        "SELECT SupplierName 
         FROM supplier 
         WHERE LoginID = ?"
    );
    $stmt->bind_param("i", $user['LoginID']);
    $stmt->execute();
    $sup = $stmt->get_result()->fetch_assoc();

    header("Location: http://localhost/DBMS/Supplier/SupplierUI.php");
    exit();
}

else if ($user['UserRole'] === 'Admin') {

    $_SESSION['name'] = 'Administrator';

    header("Location: http://localhost/DBMS/Admin/admin.html");
    exit();
}

else {
    echo "Unknown user role!";
}

$stmt->close();
$conn->close();
?>

<?php
session_start();
include 'C:\Users\Gowthaman\OneDrive\Desktop\XAMPP\htdocs\DBMS\Admin\connection.php';
if (!isset($_SESSION['order_id'])) {
    die("No order selected. Please go back and select an order.");
}

$orderid = $_SESSION['order_id'];

 $stmt = $conn->prepare("SELECT TotalAmount FROM orders WHERE OrderID = ?");
 $stmt->bind_param("i",$orderid);
 $stmt->execute();

 $result = $stmt->get_result();
 if($result->num_rows === 1){
        $row = $result->fetch_assoc();
        $TotalAmount= $row['TotalAmount'];
}   else {
        die("Order not found.");
}
 $stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <link rel="stylesheet" href="Payment.css">
    </head>

    <body>
        <form action="Payment.php" method="POST">
            <div class="container">
                <h3>Payment</h3>
                <p>Total Amount to Pay: LKR <?php echo number_format($TotalAmount, 2); ?></p>
                <input type="hidden" name="orderid" value="<?php echo $orderid; ?>">
                <select name="paymentmethod" required>
                    <option value="" disabled selected hidden>Select Payment Method</option>
                    <option value="Cash">Cash</option>
                    <option value="Card">Card</option>
                    <option value="Online Transfer">Online Transfer</option>
                </select>

                <button class="register-btn">Pay</button>

            </div>
        </form>


    </body>
   
</html>
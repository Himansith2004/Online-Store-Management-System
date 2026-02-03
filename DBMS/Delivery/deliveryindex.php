<?php
session_start();

$order_id = $_SESSION['order_id'];

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <link rel="stylesheet" href="deliveryindex.css">
    </head>

    <body>
        <form action="enterdelivery.php" method="POST">
            <div class="container">
                <h3>Delivery</h3>
                <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                <input type="text" name="address" placeholder="Address">
                <br>

                  <select name="deliverymethod" required>
                    <option value="" disabled selected hidden>Select Delivery Method</option>
                    <option value="Home Delivery">Home Delivery</option>
                    <option value="PickUp">PickUp</option>
                </select>

                <select name="deliverytype" required>
                    <option value="" disabled selected hidden>Select Delivery Type</option>
                    <option value="Same Day Delivery">Same Day Delivery</option>
                    <option value="Express Delivery">Express Delivery</option>
                    <option value="Standard Delivery">Standard Delivery</option>
                </select>

              

                <button class="register-btn">Proceed to pay </button>

            </div>
        </form>


    </body>

</html>
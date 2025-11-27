<?php
session_start();

//Must be logged in to access checkout
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?redirect = checkout.php");
    exit();
}


$cart = $_SESSION['cart'] ?? [];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #fdfbf5;
            margin: 20px;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ccc;
            text-align: center;
        }

        th {
            background: #e8e2d3;
        }

        .total-row td {
            font-weight: bold;
            font-size: 1.1em;
        }

        .btn {
            display: block;
            width: 200px;
            background-color: #1f4732;
            color: white;
            border: none;
            margin: 20px auto;
            padding: 10px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1.1em;
            border-radius: 6px;
        }
        
        .form-section {
            width: 40%;
            background: white;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        label {
            display: block;
            margin: 8px 0 4px;
        }

        input {
            width: 95%;
            padding: 10px;
            margin-bottom: 12px;
            border-radius: 5px;
            border: 1px solid #aaa;
        }

        .two-column {
            display: flex;
            gap: 25px;
            justify-content: space-between;
        }

        .column {
            width: 48%;
            background: #fafafa;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #cccccc
        }

    </style>
</head>
<body>

<h2>Your Cart</h2>

<?php
if (isset($_SESSION['payment_error'])) {
    echo "<div style='background: rgb(212, 225, 237); color: rgb(22, 158, 192); padding: 15px; border-radius: 5px; margin-bottom: 20px;'>";
    echo "<strong>Payment Error:</strong> " . htmlspecialchars($_SESSION['payment_error']);
    echo "</div>";
    unset($_SESSION['payment_error']);
}
?>

<?php if (empty($cart)): ?>
    <p style="text-align:center;">Your cart is empty.</p>

<?php else: ?>

<table>
    <tr>
        <th>Item</th>
        <th>Price</th>
        <th>Subtotal</th>
    </tr>

    <?php 
    $total = 0;

    foreach ($cart as $item):
        $name = $item['productName'] ?? "N/A";
        $price = $item['price'] ?? 0;
        $subtotal = $price;
        $total += $subtotal;
    ?>
        <tr>
            <td><?= $name ?></td>
            <td>$<?= number_format($price, 2) ?></td>
            <td>$<?= number_format($subtotal, 2) ?></td>
        </tr>
    <?php endforeach; ?>

    <tr class="total-row">
        <td colspan="1">Total</td>
        <td></td>
        <td>$<?= number_format($total, 2) ?></td>
    </tr>
</table>

<div class="form-section">
    <h3 style="text-align: center;">Checkout Information</h3>

    <form method="POST" action="place_order.php">

        <div class="two-column">
            <div class = "column">
                <label>First Name</label>
                <input type="text" name="firstname" required>

                <label>Last Name</label>
                <input type="text" name="lastname" required>

                <label>Address</label>
                <input type="text" name="address" required>

                <label>City</label>
                <input type="text" name="city" required>

                <label>State</label>
                <input type="text" name="state" required>

                <label>Zip Code</label>
                <input type="text" name="zip" required>

                <label>Phone Number</label>
                <input type="text" name="phone" required>

                <label>Email</label>
                <input type="text" name="email" optional>
            </div>
            <div class="column">
                <h3>Billing Info</h3>

                <label>Cardholder Name</label>
                <input type="text" name="cardname" optional>

                <label>Card Number</label>
                <input type="text" name="cardnumber" placeholder="1234 5678 9012 3456" required>

                <label>Expiration Date</label>
                <input type="text" name="exp" placeholder="MM/YY" required>

                <label>CVV</label>
                <input type="text" name="cvv" placeholder="123" required>
            </div>
        </div>
            <button type="submit" class="btn" >Place Order</button>

    </form>
</div>
<button class="btn" onclick="window.location.href='cart.php'">Back to Cart</button>
<?php 
endif; 
?>
</body>
</html>
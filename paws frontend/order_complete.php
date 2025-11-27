<?php
session_start();

$order_id = $_SESSION['last_order_id'] ?? null;
$total = $_SESSION['order_total'] ?? 0;
$user_email = $_SESSION['user_email'] ?? '';

unset($_SESSION['last_order_id']);
unset($_SESSION['order_total']);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Order Complete</title>
    <style>
        body {
            font-family: Arial;
            background-color: #f4f4f4;
            text-align: center;
            padding: 60px;
        }
        .box {
            background: white;
            padding: 40px;
            max-width: 600px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }
        h2 {
            color: #1c4426;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            background: #1c4426;
            color: white;
            padding: 12px 18px;
            text-decoration: none;
            border-radius: 6px;
        }
        .order-box {
            background: #1c4426;
            margin: 20px;
            padding: 15px;
            border-radius: 6px;
            border: 1px solid #1c4426;
        }
        .order-row {
            padding: 10px 0;
            border-bottom: 1px solid #1c4426;
        }
        .email-notification-confirm {
            background:rgb(232, 244, 248);
            padding: 20px;
            margin: 25px 0;
            border-radius: 5px;
        }
        .email-notification-confirm h2 {
            margin-top: 0;
            color:rgb(15, 76, 117);
            font-size: 1em;
        }
        .email-content-confirm {
            background: white;
            padding: 20px;
            border-radius: 5px;
            margin-top: 10px;
            font-size: 1em;
            line-height: 1.5;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>Thank You!</h2>
    <p>Your order has been placed successfully.</p>

    <div class ="order-box">
        <h2>Order Details</h2>
        <div class ="order-row">
            <strong>Order #: <?= $order_id?></strong>
        </div>
        <div class ="order-row">
            <strong>Total: $<?= number_format($total, 2)?></strong>
        </div>
    </div>

    <!--To simulate the email confirmation -->
    <div class="email-notification-confirm">
        <h2>Confirmation Email Sent</h2>
        <p><strong>To: </strong> <?= htmlspecialchars($user_email)?></p>
        <p><strong>Subject: </strong>Your order has been confirmed - Pawnovation Pets</p>

        <div class="email-content-confirm">
            <p>Thank you for your order with Pawnovation Pets! Here is your order information:</p>
            <p><strong>Order #: <?= $order_id?></strong><br>
               <strong>Total Amount: $<?= number_format($total, 2)?></strong>
            </p>
        </div>

        <p>This is a simulated email for demonstration.</p>
            
    </div>

    <a href="index.php">Return to Home</a>
</div>

</body>
</html>
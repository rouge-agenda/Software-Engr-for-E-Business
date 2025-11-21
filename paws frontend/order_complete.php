<?php
session_start();
$_SESSION['cart'] = [];
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
    </style>
</head>
<body>

<div class="box">
    <h2>Thank You!</h2>
    <p>Your order has been placed successfully.</p>

    <a href="index.php">Return to Home</a>
</div>

</body>
</html>
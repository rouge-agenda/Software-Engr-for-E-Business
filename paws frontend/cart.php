<?php
session_start();

$total = 0;
if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'];
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Your Cart - Pawnovation Pets</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0eee4;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .container {
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      width: 80%;
      max-width: 700px;
    }

    h2 {
      text-align: center;
      color: #1f4732;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #e0d8c3;
      color: #1f4732;
    }

    .empty-message {
      text-align: center;
      color: #777;
      padding: 40px 0;
      font-style: italic;
    }

    .total {
      text-align: right;
      font-size: 18px;
      font-weight: bold;
      color: #1f4732;
      margin-top: 20px;
    }

    .buttons {
      display: flex;
      justify-content: space-between;
      margin-top: 25px;
    }

    .btn {
      background-color: #1f4732;
      color: white;
      border: none;
      padding: 10px 18px;
      border-radius: 6px;
      cursor: pointer;
      font-size: 15px;
    }

    .btn:hover {
      background-color: #2c5b44;
    }
    
    strong {
      font-family: Arial, sans-serif;
      color:#1f4732
      text-align: left;
      text-justify: inter-word;
    }
    
    txt {
      color: #1f4732;
    }
    span {
      text-align: center;
      text-justify: inter-word;
    }
    .cart {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 8px 0;
      border-bottom: 1px solid #dddddd
    }
    .price {
      text-align: right;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Your Shopping Cart</h2>
    <table>
      <thead>
        <tr>
          <th>Items in cart</th>
        </tr>
      </thead>
  </table>
    <table>
      <tbody>
        <tr>
        <?php 
        if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
          echo "<p>Your cart is empty.</p>";
        } else {
          $total = 0;

        foreach ($_SESSION['cart'] as $index => $item) {
          echo "<div class='cart'>";
          echo "<strong>" . $item['productName'] . "</strong>";
          echo "<price>" . "$" . $item['price'] . "</span>";
          echo "<form action='remove_from_cart.php' method='POST' style='margin-top:8px;'>
                  <input type ='hidden' name='index' value='{$index}'>
                  <button type='submit' class='btn'>Remove</button>
                  <br>
                </form>";
          echo "</div>";
          $total += $item['price'];
        }
        }
        ?>
        </tr>
      </tbody>
    </table>
    <?php
    echo "<div class='total'>Total: $$total</div>";
    ?>
    <div class="buttons">
      <button class="btn" onclick="window.location.href='products.php'">Continue Shopping</button>
      <button class="btn" onclick="window.location.href='index.php'">Home</button>
      <button class="btn" onclick="window.location.href='checkout.php'">Checkout</button>
    </div>
  </div>
</body>
</html>

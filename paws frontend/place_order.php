<?php
session_start();
include('config/database.php');
include('APIs/payment_simulator.php');
include('APIs/email_simulator.php');
include('APIs/shipping_simulator.php');

//If the user isn't logged in or the cart is empty, return to cart
if (!isset($_SESSION['user_id']) || empty($_SESSION['cart'])) {

    header("Location: cart.php");
    exit();
}

$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'];
}

//Check for email to match account email
$check_email = trim($_POST['email']);

if(empty($check_email) || $check_email !== $_SESSION['user_email']) {
    $_SESSION['payment_error'] = "Please make sure the email address matches the account email.";
    header("Location: checkout.php");
    exit();
}


//Simulate process payment
$paymentResult = simulatePayPalPayment(

    $_POST['cardnumber'],
    $_POST['exp'],
    $_POST['cvv'],
    $total,
    $check_email
);

if(!$paymentResult['success']) {

    $_SESSION['payment_error'] = $paymentResult['error_message'];
    header("Location: checkout.php");
    exit();
}

$shippingResult = simulateShippoShipping(
    $_POST['address'],
    $_POST['city'],
    $_POST['state'],
    $_POST['zip'],
    $_SESSION['cart']
);


//Create new order
$user_id = $_SESSION['user_id'];
$sql = "INSERT INTO orders (custID) VALUES (?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$order_id = $conn->insert_id;

$product_quantities = [];

foreach ($_SESSION['cart'] as $item) {
    $product_id = $item['productid'];

    if (isset($product_quantities[$product_id])) {
        $product_quantities[$product_id]++;
    } else {
        $product_quantities[$product_id] = 1;
    }
}

//Add order items into order_items table in the database
foreach ($product_quantities as $product_id => $quantity) {

    $sql = "INSERT INTO orderline (orderID, productID, quantity) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $order_id, $product_id, $quantity);
    $stmt->execute();
}


$emailResult = simulateSendGridEmail(

$_SESSION['user_email'],
'Pawnovation Pets Order Confirmation',
'order_confirmation',
['order_id' => $order_id, 'total' => $total]
);

if(!$emailResult['success']) {

    error_log("Error sending order confirmation email.");
}

if(!$shippingResult['success']) {
   
    error_log("Shipping calculated for order #$order_id");
}


//Clear cart and save order details in session
unset($_SESSION['cart']);
$_SESSION['last_order_id'] = $order_id;
$_SESSION['order_total'] = $total;
header("Location: order_complete.php");
exit();
?>
<?php
session_start();
include('config/database.php'); 

$id = $_POST['productid'];
$name = $_POST['productName'];
$price = $_POST['price'];
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
$_SESSION['cart'][] = [
    "productid" => $id,
    "productName" => $name,
    "price" => $price
];
header("Location: cart.php");
exit();
?>
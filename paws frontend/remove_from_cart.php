<?php
session_start();

if (!isset($_POST['index'])) {
    header("Location: cart.php");
    exit();
}
$index = intval($_POST['index']);
if (!isset($_SESSION['cart']) || !isset($_SESSION['cart'][$index])) {
    header("Location: cart.php");
    exit();
}
unset($_SESSION['cart'][$index]);
$_SESSION['cart'] = array_values($_SESSION['cart']);
header("Location: cart.php");
exit();
?>
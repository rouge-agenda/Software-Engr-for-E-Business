<?php
$host = 'localhost';
$user = 'root';
$password = 'root';
$dbname = 'online_storefront';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
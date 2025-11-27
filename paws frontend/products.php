<?php
session_start();
include('config/database.php'); 
$search = "";
$where = "";
$category = "";
if (isset($_GET['category'])) {
    $category = $_GET['category'];
} //this makes the explore buttons on the index page work.
if ($category != "") {
    $search = mysqli_real_escape_string($conn, $_GET['category']);
    $where = "WHERE category LIKE '%$search%'";
}
if (isset($_GET['query']) && !empty($_GET['query'])) {
    $search = mysqli_real_escape_string($conn, $_GET['query']);
    $where = "WHERE productName LIKE '%$search%' 
              OR description LIKE '%$search%'";
}
$sql = "SELECT * FROM product $where";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products – Pawnovation Pets</title>
    <style>
        body {
            margin: 0;
            background-color: #F4ECD3;
            font-family: 'calibri', sans-serif;
            color: #0A3323;
        }

        .navbar {
            background-color: #F4ECD3;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid #E8D8B9;
        }

        .nav-left h1 {
            font-size: 32px;
            margin: 0;
            font-weight: bold;
            color: #0A3323;
        }

        .nav-right a {
            margin-left: 30px;
            text-decoration: none;
            color: #0A3323;
            font-size: 18px;
            font-weight: bold;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 20px;
        }

        .search-box {
            text-align: center;
            margin-bottom: 40px;
        }

        .search-input {
            width: 60%;
            padding: 12px;
            border-radius: 8px;
            border: 2px solid #C9B898;
            font-size: 18px;
            font-family: inherit;
            background-color: #FFF9EE;
        }

        .search-btn {
            padding: 12px 20px;
            margin-left: 10px;
            border: none;
            border-radius: 8px;
            background-color: #0A3323;
            color: white;
            font-size: 18px;
            cursor: pointer;
            font-family: inherit;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .product-card {
            background-color: #F2E6C9;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .product-card h2 {
            margin-top: 0;
            font-size: 26px;
            color: #0A3323;
        }

        .product-card p {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .cart-btn {
            padding: 10px 16px;
            background-color: #0A3323;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-family: inherit;
        }

        .footer {
            text-align: center;
            padding: 30px;
            margin-top: 50px;
            font-size: 16px;
            color: #0A3323;
        }
    </style>
</head>
<body>
<div class="navbar">
    <div class="nav-left">
        <h1>Pawnovation Pets</h1>
    </div>

    <div class="nav-right">
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="products.php">Shop</a>
        <a href="cart.php">Cart</a>
    </div>
</div>

<div class="container">
    <div class="search-box">
        <form action="products.php" method="GET">
            <input 
                type="text" 
                name="query" 
                placeholder="Search products..." 
                class="search-input"
                value="<?php echo htmlspecialchars($search); ?>"
            >
            <button type="submit" class="search-btn">Search</button>
        </form>
    </div>
    <h1 style="text-align:center;">Our Products</h1>
    <br>
    <div class="product-grid">
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='product-card'>";
                echo "<h2>" . $row['productName'] . "</h2>";
                echo "<p>" . $row['description'] . "</p>";
                echo "<p><strong>Price:</strong> $" . $row['price'] . "</p>";
                echo "
                <form action='add_to_cart.php' method='POST'>
                    <input type='hidden' name='productid' value='" . $row['productID'] . "'>
                    <input type='hidden' name='productName' value='" . $row['productName'] . "'>
                    <input type='hidden' name='price' value='" . $row['price'] . "'>
                    <button type='submit' class='cart-btn'>Add to Cart</button>
                </form>
                    ";
                echo "</div>";
            }
        } else {
            echo "<p>No products found.</p>";
        }
        ?>
    </div>
</div>
<div class="footer">
    Let's make pet care greener together.  
    Contact us at <strong>support@pawnovationpets.com</strong>
</div>
</body>
</html>
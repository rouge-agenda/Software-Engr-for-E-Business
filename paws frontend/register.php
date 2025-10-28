<?php
// NEW 10/25/25 - Include database connection
include('config/database.php');

// DEBUG: Check if connection exists
if (!isset($conn) || $conn === null) {
  die("<div style='background: #f8d7da; color: #721c24; padding: 20px; border-radius: 5px; margin: 20px auto; width: 300px; text-align: center;'>
      <strong>Database Connection Failed</strong><br>
      Check config/database.php
  </div>");
}

//Check form submission - Only for testing, will be removed at project completion
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $street = $_POST['address'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $zip_code = $_POST['zip_code'];
  $phone = $_POST['phone'];

  $hashed_password = $password; // Using plain text, NEEDS CHANGE to varchar length for hashed passwords

  $sql = "INSERT INTO customer (fname, lname, email, password, street, city, state, zipcode, phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssssssis", $first_name, $last_name, $email, $hashed_password, $street, $city, $state, $zip_code, $phone);

  if ($stmt->execute()) {
  //Display current data
  echo "<div style=' background:rgb(212, 225, 237); color:rgb(22, 158, 192); padding: 10px; border-radius: 5px; margin-bottom: 20px auto; width: 300px; text-align: center; margin-right: 20px; left: 50%;'>";
  echo "<strong>Registration Successful!</strong><br>";
  echo "Welcome, $first_name!<br>";
  echo "Email: $email<br>";
  echo "</div>";
  } else {
    echo "<div style=' background:rgb(212, 225, 237); color:rgb(22, 158, 192); padding: 10px; border-radius: 5px; margin-bottom: 20px auto; width: 300px; text-align: center; margin-right: 20px; left: 50%;'>";
    echo "<strong>Error:</strong> " . $conn->error;
    echo "</div>";
  }

  
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - Pawnovation Pets</title>
  <style>
    * {
      box-sizing: border-box;
    }
    body {
      font-family: Arial, sans-serif;
      background-color: #f0eee4;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .container {
      background: white;
      padding: 30px 35px;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      width: 340px;
      text-align: center;
    }
    h2 {
      color: #1f4732;
      margin-bottom: 20px;
    }
    form {
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    input {
      width: 100%;
      padding: 10px;
      margin: 6px 0;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
    }
    button {
      width: 100%;
      background-color: #1f4732;
      color: white;
      border: none;
      padding: 10px;
      border-radius: 6px;
      cursor: pointer;
      margin-top: 10px;
      font-size: 15px;
    }
    button:hover {
      background-color: #2c5b44;
    }
    .link {
      text-align: center;
      margin-top: 10px;
      font-size: 14px;
    }
    a {
      color: #1f4732;
      text-decoration: none;
      font-weight: bold;
    }
    
  </style>
</head>
<body>
  <div class="container">
    <h2>Create Account</h2>
    <form method="post" action="register.php"> 
      <input type="text" name="first_name" placeholder="First Name" required>
      <input type="text" name="last_name" placeholder="Last Name" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="text" name="address" placeholder="Address" required>
      <input type="text" name="city" placeholder="City" required>
      <input type="text" name="state" placeholder="State" required>
      <input type="text" name="zip_code" placeholder="ZIP Code" required>
      <input type="tel" name="phone" placeholder="Phone Number" required>
      <button type="submit">Register</button>
    </form>
    <div class="link">
      <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
  </div>
</body>
</html>
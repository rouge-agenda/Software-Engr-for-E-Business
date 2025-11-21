<?php
include('config/database.php'); 

//Keep user session
session_start();

//check login submission
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $email = $_POST['email'];
  $password = $_POST['password'];

  //lookup user in database
  $sql = "SELECT custID, fname, lname, password FROM customer WHERE email = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {

      $_SESSION['user_id'] = $user['custID'];
      $_SESSION['user_name'] = $user['fname'] . ' ' . $user['lname'];
      $_SESSION['user_email'] = $email;


      echo "<div style='background:rgb(212, 225, 237); color:rgb(22, 158, 192); padding: 10px; border-radius: 5px; margin-bottom: 20px auto; width: 300px; text-align: center; '>";
      echo "<strong>Login Successful!</strong><br>";
      echo "Welcome, " . $user['fname'] . "!<br>";
      echo "<form method='GET' action='index.php'>";
      echo "<button type='submit' style='background-color: rgb(212, 225, 237); color: rgb(255, 255, 255); padding: 3px; border: none; border-radius: 5px; cursor: pointer;'>Return to Homepage</button>";
      echo "</form>";
      echo "</div>";

    }
    else {    //if incorrect password
      echo "<div style='background: rgb(212, 225, 237); color: rgb(22, 158, 192); padding: 10px; border-radius: 5px; margin-bottom: 20px;'>";
      echo "<strong>Login Failed:</strong> Incorrect password.<br>";
      echo "</div>";
    }

  } else {    //if email not found
    echo "<div style='background: rgb(212, 225, 237); color: rgb(22, 158, 192); padding: 10px; border-radius: 5px; margin-bottom: 20px;'>";
    echo "<strong>Login Failed:</strong> Email not found.<br>";
    echo "</div>";
  }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Pawnovation Pets</title>
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
    <h2>Login to Your Account</h2>
    <form method="POST" action="login.php">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>
    <div class="link">
      <p>Don't have an account? <a href="register.php">Register</a></p>
      <p>Return to <a href="index.php">Home</a></p>
    </div>
  </div>
</body>
</html>


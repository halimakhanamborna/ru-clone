<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

  $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $name, $email, $password);

  if ($stmt->execute()) {
    header("Location: login.php");
    exit();
  } else {
    $error = "Email already registered.";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Signup</title>
  <link rel="stylesheet" href="cstyle.css">
</head>
<body>
<div class="container">
  <h2>Faculty Signup</h2>
  <form method="POST">
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email Address" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Register</button>
  </form>
  <p>Already registered? <a href="login.php">Login here</a></p>
  <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
</div>
</body>
</html>

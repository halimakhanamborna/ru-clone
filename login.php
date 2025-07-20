<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
  $password = $_POST["password"];

  $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $name, $hashed_password);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
      $_SESSION['user_id'] = $id;
      $_SESSION['name'] = $name;
      header("Location: dashboard.php");
      exit();
    } else {
      $error = "Incorrect password.";
    }
  } else {
    $error = "No user found.";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="cstyle.css">
</head>
<body>
<div class="container">
  <h2>Faculty Login</h2>
  <form method="POST">
    <input type="email" name="email" placeholder="Email Address" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
  </form>
  <p>Don't have an account? <a href="signup.php">Sign up</a></p>
  <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
</div>
</body>
</html>

<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <link rel="stylesheet" href="cstyle.css">
  <style>
    .dashboard-container {
      max-width: 600px;
      margin: 80px auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      text-align: center;
    }
    .dashboard-container a {
      display: block;
      margin: 15px 0;
      padding: 12px;
      background: #007b5e;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
    }
    .dashboard-container a.logout {
      background: #e74c3c;
    }
  </style>
</head>
<body>
  <div class="dashboard-container">
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?></h2>
    <a href="add_event.php">Add New Event</a>
    <a href="add_notice.php">Add New Notice</a>
    <a href="index.php" target="_top">View Homepage</a>
    <a class="logout" href="index.php">Logout</a>
  </div>
</body>
</html>

<?php
include 'db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $date = $_POST['date'];

    $imgName = time() . '_' . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], "uploads/$imgName");

    $stmt = $conn->prepare("INSERT INTO events (title, image, date) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $imgName, $date);
    $msg = $stmt->execute() ? "✅ Event added successfully!" : "❌ Error: " . $conn->error;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Event</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f1f3f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 60px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #007b5e;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="date"],
        input[type="file"] {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }
        button {
            margin-top: 20px;
            background: #007b5e;
            color: white;
            padding: 12px;
            width: 100%;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background: #005f46;
        }
        .message {
            margin-top: 10px;
            color: green;
            font-weight: bold;
            text-align: center;
        }
        .back-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #007bff;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Add New Event</h2>
    <?php if (isset($msg)) echo "<p class='message'>$msg</p>"; ?>
    <form method="POST" enctype="multipart/form-data">
        <label>Event Title</label>
        <input type="text" name="title" required>

        <label>Event Date</label>
        <input type="date" name="date" required>

        <label>Upload Image</label>
        <input type="file" name="image" accept="image/*" required>

        <button type="submit">Submit Event</button>
    </form>
    <a class="back-link" href="dashboard.php">← Back to Dashboard</a>
</div>
</body>
</html>

<?php
include 'db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['content'];
    $date = $_POST['date'];
    $pdfName = null;

    if (!empty($_FILES['pdf']['name'])) {
        $pdfName = time() . '_' . basename($_FILES['pdf']['name']);
        move_uploaded_file($_FILES['pdf']['tmp_name'], "uploads/$pdfName");
    }

    $stmt = $conn->prepare("INSERT INTO notices (content, date, pdf_file) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $content, $date, $pdfName);
    $msg = $stmt->execute() ? "✅ Notice added successfully!" : "❌ Error: " . $conn->error;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Notice</title>
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
        textarea,
        input[type="date"],
        input[type="file"] {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }
        textarea {
            resize: vertical;
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
    <h2>Add New Notice</h2>
    <?php if (isset($msg)) echo "<p class='message'>$msg</p>"; ?>
    <form method="POST" enctype="multipart/form-data">
        <label>Notice Content</label>
        <textarea name="content" rows="4" required></textarea>

        <label>Notice Date</label>
        <input type="date" name="date" required>

        <label>Upload PDF (optional)</label>
        <input type="file" name="pdf" accept=".pdf">

        <button type="submit">Submit Notice</button>
    </form>
    <a class="back-link" href="dashboard.php">← Back to Dashboard</a>
</div>
</body>
</html>

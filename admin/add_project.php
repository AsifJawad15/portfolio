<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title       = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $image       = $_POST['image'] ?? '';          // just the filename
    $github_link = $_POST['github_link'] ?? '';

    if (!empty($title) && !empty($description)) {
        $stmt = $conn->prepare("
            INSERT INTO projects (title, description, image, github_link)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->bind_param("ssss",
            $title,
            $description,
            $image,
            $github_link
        );
        $stmt->execute();
        $stmt->close();
        $success = "Project added successfully!";
    } else {
        $error = "Title and description are required.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Project</title>
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
 <?php

include __DIR__ . '/partials/admin_header.php';
?>

  <main style="margin-top:80px; padding:0 10%;">
    <h2>Add New Project</h2>
    <?php if(isset($success)): ?>
      <p class="success"><?= $success ?></p>
    <?php endif; ?>
    <?php if(isset($error)): ?>
      <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST">
      <label>Title:</label>
      <input type="text" name="title" required>

      <label>Description:</label>
      <textarea name="description" required></textarea>

      <label>Image Filename:</label>
      <input type="text" name="image">

      <label>GitHub Link:</label>
      <input type="text" name="github_link">

      <button type="submit">Add Project</button>
    </form>
  </main>
  <script src="../js/admin.js"></script>
  <?php
include __DIR__ . '/partials/admin_footer.php';
?>
</body>
</html>

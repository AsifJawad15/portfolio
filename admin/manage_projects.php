<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include '../includes/config.php';

// Deletion
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM projects WHERE id=$id");
    header("Location: manage_projects.php");
    exit();
}

// Fetch
$result = $conn->query("SELECT * FROM projects ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Projects</title>
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/admin.css">
</head>
<body class="admin-dark">
 <?php

include __DIR__ . '/partials/admin_header.php';
?>
  <main style="flex: 1; margin-top:80px; padding:0 10%;">
    <h2 class="section-title">Manage Projects</h2>
    <p><a class="btn" href="add_project.php">Add New Project</a></p>
    <div class="projects-grid">
      <?php while($row = $result->fetch_assoc()): ?>
        <div class="project-card">
          <h3><?= htmlspecialchars($row['title']) ?></h3>
          <div class="image-container">
            <img src="../images/<?= htmlspecialchars($row['image']) ?>" alt="Project Image">
          </div>
          <p><?= nl2br(htmlspecialchars($row['description'])) ?></p>
          <?php if(!empty($row['github_link'])): ?>
            <a class="github-btn" href="<?= htmlspecialchars($row['github_link']) ?>" target="_blank">
              <i class='bx bxl-github'></i> GitHub
            </a>
          <?php endif; ?>
          <div class="action-buttons">
            <a href="edit_project.php?id=<?= $row['id'] ?>">Edit</a>
            <a href="manage_projects.php?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </main>
  <script src="../js/admin.js"></script>
  <?php
include __DIR__ . '/partials/admin_footer.php';
?>
</body>
</html>

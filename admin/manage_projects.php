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
  <style>
    .projects-grid { display: grid; grid-template-columns: repeat(3,1fr); gap:20px; margin-top:20px; }
    .project-card { 
      background:#2d2d2d; 
      border:1px solid #444; 
      padding:15px; 
      border-radius:8px;
      box-shadow:0 4px 15px rgba(0,0,0,0.2); 
      text-align:center; 
      transition:transform .3s, background .3s, box-shadow .3s; 
      color: #e0e0e0;
      overflow: hidden;
    }
    .project-card:hover { 
      transform:translateY(-8px); 
      background:#3d3d3d; 
      box-shadow: 0 8px 25px rgba(181,168,213,0.3);
      border-color: #B5A8D5;
    }
    .project-card h3 {
      color: #B5A8D5;
      margin-bottom: 12px;
    }
    .project-card .image-container {
      overflow: hidden;
      border-radius: 6px;
      margin-bottom: 10px;
    }
    .project-card img { 
      width:100%; 
      height:auto; 
      border-radius:6px; 
      transition: transform 0.4s ease;
    }
    .project-card:hover img {
      transform: scale(1.05);
    }
    .github-btn {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: linear-gradient(45deg,#7A73D1,#B5A8D5);
      color: #fff;
      padding: 6px 12px;
      border-radius: 4px;
      text-decoration: none;
      font-size: 0.9rem;
      margin-bottom: 10px;
      transition: all 0.3s ease;
    }
    .github-btn:hover {
      background: linear-gradient(45deg,#B5A8D5,#7A73D1);
      transform: translateY(-2px);
    }
    .action-buttons { display:flex; justify-content:center; gap:10px; margin-top:15px; }
    .action-buttons a { 
      background:#7A73D1; 
      color:#fff; 
      padding:8px 14px; 
      border-radius:6px; 
      text-decoration:none; 
      transition: all 0.3s ease;
      font-weight: 500;
    }
    .action-buttons a:hover { 
      background:#B5A8D5; 
      transform: translateY(-2px);
    }
  </style>
</head>
<body class="admin-dark">
 <?php

include __DIR__ . '/partials/admin_header.php';
?>
  <main style="flex: 1; margin-top:80px; padding:0 10%;">
    <h2 style="color: #B5A8D5;">Manage Projects</h2>
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
  <script src="../script.js"></script>
  <?php
include __DIR__ . '/partials/admin_footer.php';
?>
</body>
</html>

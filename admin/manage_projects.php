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
    .project-card { background:#fff; border:1px solid #ccc; padding:15px; border-radius:8px;
      box-shadow:0 0 10px rgba(0,0,0,0.1); text-align:center; transition:transform .3s; }
    .project-card:hover { transform:translateY(-5px); background:#f7f7ff; }
    .project-card img { width:100%; height:auto; border-radius:8px; margin-bottom:10px; }
    .action-buttons { display:flex; justify-content:center; gap:10px; margin-top:10px; }
    .action-buttons a { background:#7A73D1; color:#fff; padding:5px 10px; border-radius:4px; text-decoration:none; }
    .action-buttons a:hover { background:#B5A8D5; }
  </style>
</head>
<body>
  <!-- ADMIN NAVBAR -->
  <header class="header">
    <a href="../index.php" class="logo">Admin Panel</a>
    <nav class="navbar">
      <a href="../index.php">Home</a>
      <a href="manage_projects.php">Projects</a>
      <a href="manage_contacts.php">Contacts</a>
      <a href="manage_credentials.php">Credentials</a>

      <a href="logout.php">Logout</a>
    </nav>
  </header>
  <main style="margin-top:80px; padding:0 10%;">
    <h2>Manage Projects</h2>
    <p><a class="btn" href="add_project.php">Add New Project</a></p>
    <div class="projects-grid">
      <?php while($row = $result->fetch_assoc()): ?>
        <div class="project-card">
          <h3><?= htmlspecialchars($row['title']) ?></h3>
          <img src="../images/<?= htmlspecialchars($row['image']) ?>" alt="Project Image">
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
</body>
</html>

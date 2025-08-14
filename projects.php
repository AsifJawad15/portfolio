<?php include 'includes/config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Projects</title>
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <style>
    .project-container { display: grid; grid-template-columns: repeat(3,1fr); gap:20px; margin-top:40px; }
    .project-card { background:#fff; border:1px solid #ddd; border-radius:4px; padding:20px;
      transition:transform .3s, box-shadow .3s, background .3s; }
    .project-card:hover { transform:translateY(-5px); background:#f7f7ff;
      box-shadow:0 0 20px rgba(122,115,209,0.8); }
    .project-card img { width:100%; height:auto; border-radius:4px; margin-bottom:15px; }
    .github-btn { display:inline-flex; align-items:center; padding:8px 12px; 
      background:linear-gradient(45deg,#7A73D1,#B5A8D5); color:#fff; border-radius:4px; }
    .github-btn:hover { background:linear-gradient(45deg,#B5A8D5,#7A73D1); }
  </style>
</head>
<body>
  <header class="header">
    <a href="index.php" class="logo">Asif Jawad</a>
    <nav class="navbar">
      <a href="index.php">Home</a>
      <a href="projects.php">Projects</a>
      <a href="contact.php">Contact</a>
      <a href="admin/login.php">Admin</a>
    </nav>
  </header>

  <section style="margin-top:80px; padding:0 10%;">
    <h2>My Projects</h2>
    <div class="project-container">
      <?php
      $result = $conn->query("SELECT * FROM projects ORDER BY id DESC");
      if ($result->num_rows > 0):
        while ($row = $result->fetch_assoc()):
      ?>
      <div class="project-card">
        <img src="images/<?= htmlspecialchars($row['image']) ?>" alt="Project Image">
        <h3><?= htmlspecialchars($row['title']) ?></h3>
        <p><?= nl2br(htmlspecialchars($row['description'])) ?></p>
        <?php if (!empty($row['github_link'])): ?>
          <a class="github-btn" href="<?= htmlspecialchars($row['github_link']) ?>" target="_blank">
            <i class='bx bxl-github'></i> GitHub
          </a>
        <?php endif; ?>
      </div>
      <?php
        endwhile;
      else:
        echo "<p>No projects found.</p>";
      endif;
      ?>
    </div>
  </section>
  <footer class="footer">
    <p>© 2025 – All Rights Reserved</p>
  </footer>
  <script src="script.js"></script>
</body>
</html>

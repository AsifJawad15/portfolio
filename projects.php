<?php include 'includes/config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Projects</title>
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/projects.css">
  <link rel="stylesheet" href="css/cookies.css">
</head>
<body>
  <header class="header">
    <a href="index.php" class="logo">Asif Jawad</a>
    <nav class="navbar">
      
      <a href="index.php"><i class='bx bx-home'></i> Home</a>
      <a href="contact.php"><i class='bx bx-envelope'></i> Contact</a>
      <a href="credentials.php"><i class='bx bx-award'></i> Credential</a>
    </nav>
  </header>

  <section style="margin-top:80px; padding:0 10%;">
    <h2 class="section-title">My Projects</h2>
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
    <div class="social">
      <a href="#"><i class='bx bxl-linkedin'></i></a>
      <a href="#"><i class='bx bxl-github'></i></a>
      <a href="#"><i class='bx bxl-facebook'></i></a>
      <a href="#"><i class='bx bxl-instagram'></i></a>
    </div>
    <p>© 2025 - All Rights Reserved</p>
  </footer>
  <script src="js/navigation.js"></script>
  <script src="js/cookies.js"></script>
</body>
</html>

<?php include 'includes/config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Credentials</title>
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <style>
    .cred-container { display: grid; grid-template-columns: repeat(3,1fr); gap:20px; margin-top:40px; }
    .cred-card { background:#fff; border:1px solid #ddd; border-radius:4px; padding:20px; text-align:center; }
    .cred-card img { max-width:100%; height:auto; border-radius:4px; margin-bottom:12px; }
  </style>
</head>
<body>
  <header class="header">
    <a href="index.php" class="logo">Asif Jawad</a>
    <nav class="navbar">
      <a href="index.php">Home</a>
      <a href="projects.php">Projects</a>
      <a href="credentials.php">Credentials</a>
      <a href="contact.php">Contact</a>
      <a href="admin/login.php">Admin</a>
    </nav>
  </header>

  <section style="margin-top:80px; padding:0 10%;">
    <h2>My Credentials</h2>
    <div class="cred-container">
      <?php
      $result = $conn->query("SELECT * FROM credentials ORDER BY id DESC");
      if ($result && $result->num_rows > 0):
        while ($row = $result->fetch_assoc()):
      ?>
      <div class="cred-card">
        <?php if (!empty($row['image'])): ?>
          <img src="images/<?= htmlspecialchars($row['image']) ?>" alt="Image">
        <?php endif; ?>
        <h3><?= htmlspecialchars($row['name']) ?></h3>
        <p><?= nl2br(htmlspecialchars($row['description'])) ?></p>
        <?php if (!empty($row['certificate_image'])): ?>
          <p><strong>Certificate:</strong><br><img src="images/<?= htmlspecialchars($row['certificate_image']) ?>" alt="Certificate" style="max-width:220px;"></p>
        <?php endif; ?>
      </div>
      <?php
        endwhile;
      else:
        echo "<p>No credentials found.</p>";
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

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
    .cred-card { 
      background:#2d2d2d; 
      border:1px solid #444; 
      border-radius:8px; 
      padding:20px; 
      text-align:center; 
      color: #e0e0e0;
      transition: transform 0.3s, box-shadow 0.3s, background 0.3s;
      overflow: hidden;
    }
    .cred-card:hover {
      transform: translateY(-8px);
      background: #3d3d3d;
      box-shadow: 0 8px 25px rgba(181,168,213,0.3);
      border-color: #B5A8D5;
    }
    .cred-card .image-container {
      overflow: hidden;
      border-radius: 6px;
      margin-bottom: 15px;
    }
    .cred-card img { 
      max-width:100%; 
      height:auto; 
      border-radius:6px; 
      transition: transform 0.4s ease;
    }
    .cred-card:hover img {
      transform: scale(1.05);
    }
    .cred-card h3 {
      color: #B5A8D5;
      margin-bottom: 12px;
      font-size: 1.3rem;
    }
    .cred-card p {
      color: #e0e0e0;
      line-height: 1.6;
    }
    .cred-card p strong {
      color: #B5A8D5;
    }
    @media (max-width: 768px) {
      .cred-container { grid-template-columns: repeat(2,1fr); gap:15px; }
    }
    @media (max-width: 480px) {
      .cred-container { grid-template-columns: 1fr; }
    }
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

  <main style="flex: 1; margin-top:80px; padding:0 10%;">
    <h2 style="color: #B5A8D5;">My Credentials</h2>
    <div class="cred-container">
      <?php
      $result = $conn->query("SELECT * FROM credentials ORDER BY id DESC");
      if ($result && $result->num_rows > 0):
        while ($row = $result->fetch_assoc()):
      ?>
      <div class="cred-card">
        <?php if (!empty($row['image'])): ?>
          <div class="image-container">
            <img src="images/<?= htmlspecialchars($row['image']) ?>" alt="Image">
          </div>
        <?php endif; ?>
        <h3><?= htmlspecialchars($row['name']) ?></h3>
        <p><?= nl2br(htmlspecialchars($row['description'])) ?></p>
        <?php if (!empty($row['certificate_image'])): ?>
          <p><strong>Certificate:</strong><br>
          <div class="image-container">
            <img src="images/<?= htmlspecialchars($row['certificate_image']) ?>" alt="Certificate" style="max-width:220px;">
          </div>
          </p>
        <?php endif; ?>
      </div>
      <?php
        endwhile;
      else:
        echo "<p>No credentials found.</p>";
      endif;
      ?>
    </div>
  </main>
  <footer class="footer">
    <p>© 2025 – All Rights Reserved</p>
  </footer>
  <script src="script.js"></script>
</body>
</html>

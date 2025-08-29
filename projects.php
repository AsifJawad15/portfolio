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
    .project-card { 
      background:#2d2d2d; 
      border:1px solid #444; 
      border-radius:8px; 
      padding:20px;
      transition:transform .3s, box-shadow .3s, background .3s; 
      overflow: hidden;
      color: #e0e0e0;
    }
    .project-card:hover { 
      transform:translateY(-8px); 
      background:#3d3d3d;
      border: 2px solid;
      border-image: linear-gradient(45deg, #00bfff, #8a2be2, #9932cc) 1;
      box-shadow: 0 0 20px rgba(0, 191, 255, 0.5), 0 0 30px rgba(138, 43, 226, 0.3), 0 0 40px rgba(153, 50, 204, 0.2);
    }
    .project-card .image-container {
      overflow: hidden;
      border-radius: 6px;
      margin-bottom: 15px;
    }
    .project-card img { 
      width:100%; 
      height:200px; 
      object-fit: cover;
      border-radius:6px; 
      transition: transform 0.4s ease;
    }
    .project-card:hover img {
      transform: scale(1.1);
    }
    .project-card h3 {
      color: #B5A8D5;
      margin-bottom: 10px;
      font-size: 1.3rem;
    }
    .project-card p {
      color: #e0e0e0;
      line-height: 1.6;
      margin-bottom: 15px;
    }
    .github-btn { 
      display:inline-flex; 
      align-items:center; 
      gap: 6px;
      padding:10px 16px; 
      background: linear-gradient(45deg, rgba(0, 191, 255, 0.8), rgba(138, 43, 226, 0.8));
      backdrop-filter: blur(10px);
      color:#fff; 
      border-radius:6px; 
      text-decoration: none;
      font-weight: 500;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(0, 191, 255, 0.3);
    }
    .github-btn:hover { 
      border: 2px solid;
      border-image: linear-gradient(45deg, #00bfff, #8a2be2, #9932cc) 1;
      box-shadow: 0 0 20px rgba(0, 191, 255, 0.5), 0 0 30px rgba(138, 43, 226, 0.3), 0 0 40px rgba(153, 50, 204, 0.2);
      transform: translateY(-2px);
    }
    .github-btn i {
      font-size: 1.1rem;
    }
    @media (max-width: 768px) {
      .project-container { grid-template-columns: repeat(2,1fr); gap:15px; }
    }
    @media (max-width: 480px) {
      .project-container { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>
  <header class="header">
    <a href="index.php" class="logo">Asif Jawad</a>
    <nav class="navbar">
      
      <a href="index.php">Home</a>
      <a href="contact.php">Contact</a>
      <a href="credentials.php">Credential</a>
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
    <div class="social">
      <a href="#"><i class='bx bxl-linkedin'></i></a>
      <a href="#"><i class='bx bxl-github'></i></a>
      <a href="#"><i class='bx bxl-facebook'></i></a>
      <a href="#"><i class='bx bxl-instagram'></i></a>
    </div>
    <p>© 2025 - All Rights Reserved</p>
  </footer>
  <script src="script.js"></script>
</body>
</html>

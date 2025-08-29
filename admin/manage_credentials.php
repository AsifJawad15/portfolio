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
    $conn->query("DELETE FROM credentials WHERE id=$id");
    header("Location: manage_credentials.php");
    exit();
}

// Fetch
$result = $conn->query("SELECT * FROM credentials ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Credentials</title>
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
  
  <style>
    .credentials-grid { display: grid; grid-template-columns: repeat(3,1fr); gap:20px; margin-top:20px; }
    .credential-card {
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
    .credential-card:hover { 
      transform:translateY(-8px); 
      background:#3d3d3d; 
      box-shadow: 0 8px 25px rgba(181,168,213,0.3);
      border-color: #B5A8D5;
    }
    .credential-card h3 {
      color: #B5A8D5;
      margin-bottom: 12px;
    }
    .credential-card .image-container {
      overflow: hidden;
      border-radius: 6px;
      margin-bottom: 10px;
    }
    .credential-card img { 
      width:100%; 
      height:auto; 
      border-radius:6px; 
      transition: transform 0.4s ease;
    }
    .credential-card:hover img {
      transform: scale(1.05);
    }
    .action-buttons { display:flex; justify-content:center; gap:10px; margin-top:15px; }
    .action-buttons a { 
      background: linear-gradient(45deg, rgba(0, 191, 255, 0.8), rgba(138, 43, 226, 0.8));
      backdrop-filter: blur(10px);
      color:#fff; 
      padding:8px 14px; 
      border-radius:6px; 
      text-decoration:none; 
      transition: all 0.3s ease;
      font-weight: 500;
      box-shadow: 0 4px 15px rgba(0, 191, 255, 0.3);
    }
    .action-buttons a:hover { 
      border: 2px solid;
      border-image: linear-gradient(45deg, #00bfff, #8a2be2, #9932cc) 1;
      box-shadow: 0 0 20px rgba(0, 191, 255, 0.5), 0 0 30px rgba(138, 43, 226, 0.3), 0 0 40px rgba(153, 50, 204, 0.2);
      transform: translateY(-2px);
    }
    @media (max-width:900px){
      .credentials-grid { grid-template-columns: repeat(2,1fr); }
    }
    @media (max-width:520px){
      .credentials-grid { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body class="admin-dark">
<?php

include __DIR__ . '/partials/admin_header.php';
?>

  <main style="flex: 1; margin-top:80px; padding:0 10%;">
    <h2 style="color: #B5A8D5;">Manage Credentials</h2>
    <p><a class="btn" href="add_credential.php">Add New Credential</a></p>

    <?php if ($result && $result->num_rows > 0): ?>
      <div class="credentials-grid">
        <?php while ($row = $result->fetch_assoc()): ?>
          <div class="credential-card">
            <h3><?= htmlspecialchars($row['name']) ?></h3>

            <?php if (!empty($row['image'])): ?>
              <div class="image-container">
                <img src="../images/<?= htmlspecialchars($row['image']) ?>" alt="Credential Image">
              </div>
            <?php endif; ?>

            <p><?= nl2br(htmlspecialchars($row['description'])) ?></p>

            <div class="action-buttons">
              <a href="edit_credential.php?id=<?= $row['id'] ?>">Edit</a>
              <a href="manage_credentials.php?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    <?php else: ?>
      <p>No credentials found. <a class="btn" href="add_credential.php">Add one now</a>.</p>
    <?php endif; ?>
  </main>

  <script src="../script.js"></script>
  <?php
include __DIR__ . '/partials/admin_footer.php';
?>
</body>
</html>

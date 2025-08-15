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
      background:#fff;
      border:1px solid #ccc;
      padding:15px;
      border-radius:8px;
      box-shadow:0 0 10px rgba(0,0,0,0.1);
      text-align:center;
      transition:transform .3s;
    }
    .credential-card:hover { transform:translateY(-5px); background:#f7f7ff; }
    .credential-card img { width:100%; height:auto; border-radius:8px; margin-bottom:10px; }
    .action-buttons { display:flex; justify-content:center; gap:10px; margin-top:10px; }
    .action-buttons a { background:#7A73D1; color:#fff; padding:5px 10px; border-radius:4px; text-decoration:none; }
    .action-buttons a:hover { background:#B5A8D5; }
    @media (max-width:900px){
      .credentials-grid { grid-template-columns: repeat(2,1fr); }
    }
    @media (max-width:520px){
      .credentials-grid { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>
  <!-- ADMIN NAVBAR -->
  <header class="header">
    <a href="../index.php" class="logo">Admin Panel</a>
    <nav class="navbar">
      <a href="../index.php">Home</a>
      <a href="manage_projects.php">Projects</a>
      <a href="manage_credentials.php">Credentials</a>
      <a href="manage_contacts.php">Contacts</a>
      <a href="logout.php">Logout</a>
    </nav>
  </header>

  <main style="margin-top:80px; padding:0 10%;">
    <h2>Manage Credentials</h2>
    <p><a class="btn" href="add_credential.php">Add New Credential</a></p>

    <?php if ($result && $result->num_rows > 0): ?>
      <div class="credentials-grid">
        <?php while ($row = $result->fetch_assoc()): ?>
          <div class="credential-card">
            <h3><?= htmlspecialchars($row['name']) ?></h3>

            <?php if (!empty($row['image'])): ?>
              <img src="../images/<?= htmlspecialchars($row['image']) ?>" alt="Credential Image">
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
</body>
</html>

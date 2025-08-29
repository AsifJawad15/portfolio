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
  <link rel="stylesheet" href="../css/admin.css">
</head>
<body class="admin-dark">
<?php

include __DIR__ . '/partials/admin_header.php';
?>

  <main style="flex: 1; margin-top:80px; padding:0 10%;">
    <h2 class="section-title">Manage Credentials</h2>
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

  <script src="../js/admin.js"></script>
  <?php
include __DIR__ . '/partials/admin_footer.php';
?>
</body>
</html>

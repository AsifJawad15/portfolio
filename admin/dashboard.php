<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); }
include '../includes/config.php';
$projectCount = $conn->query("SELECT COUNT(*) AS cnt FROM projects")->fetch_assoc()['cnt'];
$contactCount = $conn->query("SELECT COUNT(*) AS cnt FROM contacts")->fetch_assoc()['cnt'];
$credCount = $conn->query("SELECT COUNT(*) AS cnt FROM credentials")->fetch_assoc()['cnt'];
$skillCount = $conn->query("SELECT COUNT(*) AS cnt FROM skills")->fetch_assoc()['cnt'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
  <style>
    main { padding:100px 10%; }
    .welcome { display:flex; justify-content:space-between; align-items:center; gap:12px; flex-wrap:wrap }
    .welcome h2 { color:#211C84 }
  </style>
</head>
<body>
<main>
  <div class="welcome">
    <div>
      <h2>Welcome, Admin</h2>
      <p>Overview of your portfolio content</p>
    </div>
    <div style="text-align:right">
      <a href="logout.php" style="background:#7A73D1;color:#fff;padding:8px 12px;border-radius:6px;text-decoration:none">Logout</a>
    </div>
  </div>

  <div class="admin-grid" style="margin-top:28px">
    <a class="admin-card" href="manage_projects.php">
      <div class="icon"><i class='bx bx-briefcase'></i></div>
      <div class="title">Projects</div>
      <div class="count"><?php echo (int)$projectCount; ?></div>
    </a>

    <a class="admin-card" href="manage_skills.php">
      <div class="icon"><i class='bx bx-star'></i></div>
      <div class="title">Skills</div>
      <div class="count"><?php echo (int)$skillCount; ?></div>
    </a>

    <a class="admin-card" href="manage_credentials.php">
      <div class="icon"><i class='bx bx-certification'></i></div>
      <div class="title">Credentials</div>
      <div class="count"><?php echo (int)$credCount; ?></div>
    </a>

    <a class="admin-card" href="manage_contacts.php">
      <div class="icon"><i class='bx bx-message-square-detail'></i></div>
      <div class="title">Contacts</div>
      <div class="count"><?php echo (int)$contactCount; ?></div>
    </a>

    <a class="admin-card" href="logout.php">
      <div class="icon"><i class='bx bx-log-out'></i></div>
      <div class="title">Logout</div>
      <div class="count">&nbsp;</div>
    </a>
  </div>
</main>
<?php
include __DIR__ . '/partials/admin_footer.php';
?>
</body>
</html>

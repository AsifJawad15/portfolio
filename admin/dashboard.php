<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include '../includes/config.php';

$projectCount = $conn->query("SELECT COUNT(*) AS cnt FROM projects")->fetch_assoc()['cnt'];
$contactCount = $conn->query("SELECT COUNT(*) AS cnt FROM contacts")->fetch_assoc()['cnt'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Boxicons (icons) -->
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <!-- Main CSS -->
  <link rel="stylesheet" href="../css/style.css">
  <style>
    .dashboard {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      margin-top: 80px;
      padding: 0 10%;
    }
    .card {
      flex: 1 1 200px;
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 20px;
      text-align: center;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .card h3 {
      margin-bottom: 10px;
      font-size: 1.2rem;
    }
    .card p {
      font-size: 2rem;
      margin: 0;
    }
    .actions {
      margin-top: 40px;
      padding: 0 10%;
    }
    .actions a {
      display: inline-block;
      margin-right: 15px;
      padding: 10px 15px;
      background: #7A73D1;
      color: #fff;
      border-radius: 4px;
      text-decoration: none;
      transition: background 0.3s;
    }
    .actions a:hover {
      background: #5e56a3;
    }
  </style>
</head>
<body>
  <!-- ADMIN NAVBAR (SAME STYLE AS MAIN) -->
  <header class="header">
    <a href="dashboard.php" class="logo">Admin Panel</a>
    <i class='bx bx-menu' id="menu-icon"></i>
    <nav class="navbar">
      <a href="dashboard.php">Dashboard</a>
      <a href="manage_projects.php">Projects</a>
      <a href="manage_contacts.php">Contacts</a>
      <a href="../index.php">Back</a>
      <a href="logout.php">Logout</a>
    </nav>
  </header>

  <!-- DASHBOARD CONTENT -->
  <main style="margin-top:80px; padding:0 10%;">
    <h2>Welcome to the Admin Dashboard</h2>
    <p>Use the links in the navbar to manage projects and contacts.</p>

    <div class="dashboard">
      <div class="card">
        <h3>Total Projects</h3>
        <p><?php echo $projectCount; ?></p>
      </div>
      <div class="card">
        <h3>Total Contacts</h3>
        <p><?php echo $contactCount; ?></p>
      </div>
    </div>

    <section class="actions">
      <a href="add_project.php"><i class='bx bx-plus'></i> Add New Project</a>
      <a href="manage_projects.php"><i class='bx bx-task'></i> Manage Projects</a>
      <a href="manage_contacts.php"><i class='bx bx-message-square-detail'></i> View Contacts</a>
    </section>
  </main>

  <script src="../script.js"></script>
</body>
</html>

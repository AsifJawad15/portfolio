<?php
session_start();
if (!isset($_SESSION['admin'])) { 
    header("Location: login.php"); 
    exit(); 
}
include '../includes/config.php';  // Correct path to config.php

// Fetch dynamic counts from the database
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
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body class="admin-dark">
<main>
    <div class="welcome">
        <div>
            <h2 class="section-title">Admin Panel</h2>
            <p>Overview</p>
        </div>
        <div style="text-align:right">
            <a href="logout.php" class="logout-btn">
                <i class='bx bx-log-out'></i>Logout
            </a>
        </div>
    </div>

    <div class="admin-grid">
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
    </div>
</main>

<?php
include __DIR__ . '/partials/admin_footer.php';
?>

</body>
</html>

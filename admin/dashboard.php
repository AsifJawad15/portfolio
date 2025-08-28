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
    <style>
        /* General padding */
        main { 
            padding: 40px 5%;
        }

        /* Welcome section and layout */
        .welcome { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            gap: 12px; 
            flex-wrap: wrap;
        }

        /* Welcome text styles */
        .welcome h2 { 
            color: #B5A8D5; 
            font-size: 28px;
        }

        .welcome p {
            color: #e0e0e0;
        }

        /* Logout button styles */
        .logout-btn {
            text-align: left;
            padding: 10px;
            background: #7A73D1;
            color: #fff;
            border-radius: 6px;
            text-decoration: none;
        }

        .logout-btn i {
            font-size: 20px;
            margin-right: 5px;
        }

        /* Admin Grid Layout (2x2) */
        .admin-grid { 
            display: grid; 
            grid-template-columns: repeat(2, 1fr); 
            gap: 20px;
            margin-top: 40px;
        }

        /* Admin Card Styles */
        .admin-card {
            background: #2d2d2d;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s, background 0.3s, box-shadow 0.3s;
            color: #e0e0e0;
            text-decoration: none;
            border: 1px solid #444;
        }

        .admin-card:hover {
            transform: translateY(-8px);
            background: #3d3d3d;
            box-shadow: 0 8px 25px rgba(181,168,213,0.3);
            border-color: #B5A8D5;
        }

        .admin-card .icon {
            font-size: 50px;
            color: #B5A8D5;
            transition: transform 0.3s ease;
        }

        .admin-card:hover .icon {
            transform: scale(1.1);
        }

        .admin-card .title {
            font-size: 24px;
            margin-top: 10px;
            font-weight: bold;
            color: #e0e0e0;
        }

        .admin-card .count {
            font-size: 30px;
            color: #B5A8D5;
            margin-top: 5px;
            font-weight: bold;
        }

        /* Responsive tweaks */
        @media (max-width: 768px) {
            .admin-card .icon {
                font-size: 40px;
            }

            .admin-card .title {
                font-size: 22px;
            }

            .admin-card .count {
                font-size: 28px;
            }
        }
    </style>
</head>
<body class="admin-dark">
<main>
    <div class="welcome">
        <div>
            <h2>Admin Panel</h2>
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

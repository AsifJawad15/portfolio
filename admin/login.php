<?php
session_start();
include '../includes/config.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    // Simple MD5 hashing; consider stronger hashing like password_hash
    $password = md5($_POST['password'] ?? '');

    $stmt = $conn->prepare("SELECT * FROM admin_users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        $_SESSION['admin'] = $username;
        header("Location: manage_projects.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <!-- ADMIN NAVBAR -->
  <header class="header">
    <a href="../index.php" class="logo">Admin Panel</a>
    <i class='bx bx-menu' id="menu-icon"></i>
    <nav class="navbar">
      <a href="../index.php">Home</a>
      <a href="manage_projects.php">Projects</a>
      <a href="manage_contacts.php">Contacts</a>
      <a href="logout.php">Logout</a>
    </nav>
  </header>

  <!-- LOGIN FORM -->
  <main style="margin-top:80px; padding:0 10%;">
    <h2>Admin Login</h2>
    <?php if(isset($error)): ?>
      <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST">
      <label>Username:</label>
      <input type="text" name="username" required>

      <label>Password:</label>
      <input type="password" name="password" required>

      <button type="submit">Login</button>
    </form>
  </main>

  <script src="../script.js"></script>
</body>
</html>

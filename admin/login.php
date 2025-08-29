<?php
// admin/login.php
session_start();
include '../includes/config.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    // NOTE: you're using MD5 in DB — consider migrating to password_hash() later
    $password = md5($_POST['password'] ?? '');

    $stmt = $conn->prepare("SELECT id, username FROM admin_users WHERE username = ? AND password = ? LIMIT 1");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($row = $res->fetch_assoc()) {
        // Successful login
        session_regenerate_id(true);
        $_SESSION['admin'] = $row['username']; // or use id: $_SESSION['admin_id'] = $row['id'];

        $stmt->close();
        // Redirect to dashboard (not manage_projects)
        header("Location: dashboard.php");
        exit();
    } else {
        $stmt->close();
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
  <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

  <!-- LOGIN FORM (no admin header here) -->
  <main style="margin-top:80px; padding:0 10%;">
    <h2>Admin Login</h2>
    <?php if(isset($error)): ?>
      <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <form method="POST">
      <label>Username:</label>
      <input type="text" name="username" required>

      <label>Password:</label>
      <input type="password" name="password" required>

      <button type="submit">Login</button>
    </form>
  </main>

  <script src="../js/admin.js"></script>
</body>
</html>

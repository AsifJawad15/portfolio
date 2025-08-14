<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include '../includes/config.php';

// Handle delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM contacts WHERE id=$id");
    header("Location: manage_contacts.php");
    exit();
}

$result = $conn->query("SELECT * FROM contacts ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Contacts</title>
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

  <main style="margin-top:80px; padding:0 10%;">
    <h2>Manage Contacts</h2>
    <table>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Message</th>
        <th>Action</th>
      </tr>
      <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['message']); ?></td>
            <td>
              <a href="manage_contacts.php?delete=<?php echo $row['id']; ?>"
                 onclick="return confirm('Are you sure?')">
                 Delete
              </a>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="5">No contacts found.</td></tr>
      <?php endif; ?>
    </table>
  </main>

  <script src="../script.js"></script>
</body>
</html>

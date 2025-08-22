<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include '../includes/config.php';

// Handle delete (use prepared statement for safety)
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM contacts WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: manage_contacts.php");
    exit();
}

// Fetch contacts
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

<?php

include __DIR__ . '/partials/admin_header.php';
?>

<main style="margin-top:100px; padding:20px 5%;">
  <h2>Manage Contacts</h2>

  <table>
    <thead>
      <tr>
        <th style="width:60px">ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Message</th>
        <th style="width:120px">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?php echo (int)$row['id']; ?></td>
          <td><?php echo htmlspecialchars($row['name']); ?></td>
          <td><?php echo htmlspecialchars($row['email']); ?></td>
          <td><?php echo nl2br(htmlspecialchars($row['message'])); ?></td>
          <td>
            <a href="manage_contacts.php?delete=<?php echo (int)$row['id']; ?>"
               onclick="return confirm('Delete this contact?');">
               Delete
            </a>
          </td>
        </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="5" style="text-align:center">No contacts found.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</main>

<?php
include __DIR__ . '/partials/admin_footer.php';
?>

</body>
</html>

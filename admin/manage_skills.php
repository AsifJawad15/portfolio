<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); }
include '../includes/config.php';

// Delete action (prepared statement)
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $conn->prepare("DELETE FROM skills WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: manage_skills.php?m=deleted");
    exit();
}

// Fetch skills
$res = $conn->query("SELECT * FROM skills ORDER BY category, sort_order, id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Manage Skills</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php include __DIR__ . '/partials/admin_header.php'; ?>

<main style="margin-top:100px;padding:20px 5%;">
  <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;">
    <h2 style="margin:0">Manage Skills</h2>
    <!-- Add Skill button next to heading (like Projects page) -->
    <p style="margin:0">
      <a class="btn" href="add_skill.php"><i class="bx bx-plus"></i> Add Skill</a>
    </p>
  </div>

  <?php if (isset($_GET['m'])): ?>
    <p class="success"><?php echo htmlspecialchars($_GET['m']); ?></p>
  <?php endif; ?>

  <table style="margin-top:16px;">
    <thead><tr><th>ID</th><th>Name</th><th>Percentage</th><th>Category</th><th>Sort</th><th>Actions</th></tr></thead>
    <tbody>
      <?php while ($row = $res->fetch_assoc()): ?>
      <tr>
        <td><?php echo (int)$row['id']; ?></td>
        <td><?php echo htmlspecialchars($row['name']); ?></td>
        <td><?php echo (int)$row['percentage']; ?>%</td>
        <td><?php echo htmlspecialchars($row['category']); ?></td>
        <td><?php echo (int)$row['sort_order']; ?></td>
        <td>
          <a href="edit_skill.php?id=<?php echo $row['id']; ?>">Edit</a> |
          <a href="manage_skills.php?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this skill?')">Delete</a>
        </td>
      </tr>
      <?php endwhile; ?>
      <?php if ($res->num_rows === 0): ?>
        <tr><td colspan="6" style="text-align:center">No skills found.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</main>

<?php include __DIR__ . '/partials/admin_footer.php'; ?>
</body>
</html>

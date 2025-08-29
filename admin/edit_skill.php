<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); }
include '../includes/config.php';

if (!isset($_GET['id'])) { header("Location: manage_skills.php"); exit(); }
$id = (int)$_GET['id'];
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $category = trim($_POST['category']);
    $percentage = (int)$_POST['percentage'];
    $sort_order = (int)$_POST['sort_order'];

    if ($name === '' || $percentage < 0 || $percentage > 100) {
        $msg = '<p class="error">Invalid input.</p>';
    } else {
        $stmt = $conn->prepare("UPDATE skills SET name = ?, percentage = ?, category = ?, sort_order = ? WHERE id = ?");
        $stmt->bind_param("sisii", $name, $percentage, $category, $sort_order, $id);
        if ($stmt->execute()) {
            header("Location: manage_skills.php?m=updated");
            exit();
        } else {
            $msg = '<p class="error">Database error.</p>';
        }
    }
}

$stmt = $conn->prepare("SELECT * FROM skills WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$skill = $res->fetch_assoc();
if (!$skill) { header("Location: manage_skills.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Edit Skill</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
<?php

include __DIR__ . '/partials/admin_header.php';
?>

<main style="margin-top:80px;padding:20px 10%;">
  <h2>Edit Skill</h2>
  <?php echo $msg; ?>
  <form method="post">
    <input name="name" value="<?php echo htmlspecialchars($skill['name']); ?>" required>
    <input name="percentage" type="number" min="0" max="100" value="<?php echo (int)$skill['percentage']; ?>" required>
    <input name="category" value="<?php echo htmlspecialchars($skill['category']); ?>" required>
    <input name="sort_order" type="number" value="<?php echo (int)$skill['sort_order']; ?>">
    <button type="submit">Update Skill</button>
  </form>
  <p><a href="manage_skills.php">Back to Manage Skills</a></p>
</main>
<script src="../js/admin.js"></script>
<?php
include __DIR__ . '/partials/admin_footer.php';
?>
</body>
</html>

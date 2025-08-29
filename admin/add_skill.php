<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); }
include '../includes/config.php';

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $category = trim($_POST['category']);
    $percentage = (int)$_POST['percentage'];
    $sort_order = (int)$_POST['sort_order'];

    if ($name === '' || $percentage < 0 || $percentage > 100) {
        $msg = '<p class="error">Invalid input. Name required. Percentage 0-100.</p>';
    } else {
        $stmt = $conn->prepare("INSERT INTO skills (name, percentage, category, sort_order) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sisi", $name, $percentage, $category, $sort_order);
        if ($stmt->execute()) {
            $stmt->close();
            header("Location: manage_skills.php?m=added");
            exit();
        } else {
            $msg = '<p class="error">Database error.</p>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Add Skill</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

<?php include __DIR__ . '/partials/admin_header.php'; ?>

<main style="margin-top:100px;padding:20px 10%;">
  <h2>Add New Skill</h2>
  <?php echo $msg; ?>
  <form method="post" style="max-width:600px;">
    <input name="name" placeholder="Skill name (e.g. Python)" required>
    <input name="percentage" type="number" min="0" max="100" placeholder="Percentage (0-100)" value="50" required>
    <input name="category" placeholder="Category (e.g. Programming)" value="General" required>
    <input name="sort_order" type="number" placeholder="Sort order (small first)" value="0">
    <button type="submit">Add Skill</button>
  </form>
  <p style="margin-top:12px;"><a href="manage_skills.php">Back to Manage Skills</a></p>
</main>

<?php include __DIR__ . '/partials/admin_footer.php'; ?>
</body>
</html>

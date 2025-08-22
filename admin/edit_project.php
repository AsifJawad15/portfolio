<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include '../includes/config.php';

if (!isset($_GET['id'])) {
    header("Location: manage_projects.php");
    exit();
}
$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM projects WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$project = $result->fetch_assoc();
$stmt->close();

if (!$project) {
    echo "Project not found.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $image = $_POST['image'] ?? '';
    $github_link = $_POST['github_link'] ?? '';
    
    if (!empty($title) && !empty($description)) {
        $stmt = $conn->prepare("UPDATE projects SET title = ?, description = ?, image = ?, github_link = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $title, $description, $image, $github_link, $id);
        $stmt->execute();
        $stmt->close();
        header("Location: manage_projects.php");
        exit();
    } else {
        $error = "Title and description are required.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Project</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Boxicons for icons -->
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <?php

include __DIR__ . '/partials/admin_header.php';
?>
  <main style="margin-top:80px; padding:0 10%;">
    <h2>Edit Project</h2>
    <?php if(isset($error)): ?>
      <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST">
      <label>Title:</label>
      <input type="text" name="title" value="<?php echo htmlspecialchars($project['title']); ?>" required>
      <label>Description:</label>
      <textarea name="description" required><?php echo htmlspecialchars($project['description']); ?></textarea>
      <label>Image Filename (e.g., project1.png):</label>
      <input type="text" name="image" value="<?php echo htmlspecialchars($project['image']); ?>">
      <label>GitHub Link:</label>
      <input type="text" name="github_link" value="<?php echo htmlspecialchars($project['github_link']); ?>">
      <button type="submit">Update Project</button>
    </form>
  </main>
  <script src="../script.js"></script>
  <?php
include __DIR__ . '/partials/admin_footer.php';
?>
</body>
</html>

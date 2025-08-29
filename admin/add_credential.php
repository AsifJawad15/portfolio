<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include '../includes/config.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $image = trim($_POST['image'] ?? ''); // filename stored in images/

    if ($name === '') {
        $error = "Name is required.";
    } else {
        $stmt = $conn->prepare("INSERT INTO credentials (name, description, image) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $description, $image);
        $stmt->execute();
        header("Location: manage_credentials.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Add Credential</title>
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
<?php

include __DIR__ . '/partials/admin_header.php';
?>

  <main>
    <h2>Add Credential</h2>

    <?php if ($error): ?><p class="error"><?= htmlspecialchars($error) ?></p><?php endif; ?>

    <form method="post">
      <label>Name:</label>
      <input type="text" name="name" required>

      <label>Description:</label>
      <textarea name="description" rows="5"></textarea>

      <label>Image Filename (place file in /images then give filename):</label>
      <input type="text" name="image" placeholder="example.jpg">
      <p class="hint">Tip: upload your image to the <code>/images</code> folder and type the filename here (e.g. <code>cred1.jpg</code>).</p>

      <button type="submit">Add Credential</button>
    </form>
  </main>
<?php
include __DIR__ . '/partials/admin_footer.php';
?>
  <script src="../js/admin.js"></script>
</body>
</html>

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
  <style>
    main { margin-top:80px; padding:0 10%; }
    form { max-width:700px; background:#fff; padding:20px; border-radius:8px; border:1px solid #ddd; }
    form label { display:block; margin-top:10px; font-weight:600; }
    form input[type="text"], form textarea { width:100%; padding:8px; border:1px solid #ccc; border-radius:4px; }
    form button { margin-top:12px; padding:10px 15px; background:#7A73D1; color:#fff; border:none; border-radius:6px; cursor:pointer; }
    .error { color:#c00; margin-top:8px; }
    .hint { font-size:0.9rem; color:#666; margin-top:6px; }
  </style>
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
  <script src="../script.js"></script>
</body>
</html>

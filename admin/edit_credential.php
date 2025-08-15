<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include '../includes/config.php';

if (!isset($_GET['id'])) {
    header("Location: manage_credentials.php");
    exit();
}
$id = intval($_GET['id']);

// fetch existing
$stmt = $conn->prepare("SELECT * FROM credentials WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$cred = $res->fetch_assoc();
if (!$cred) {
    header("Location: manage_credentials.php");
    exit();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $image = trim($_POST['image'] ?? '');

    if ($name === '') {
        $error = "Name is required.";
    } else {
        $stmt = $conn->prepare("UPDATE credentials SET name = ?, description = ?, image = ? WHERE id = ?");
        $stmt->bind_param("sssi", $name, $description, $image, $id);
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
  <title>Edit Credential</title>
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
    .preview { margin-top:8px; }
  </style>
</head>
<body>
  <header class="header">
    <a href="../index.php" class="logo">Admin Panel</a>
    <nav class="navbar">
      <a href="../index.php">Home</a>
      <a href="manage_projects.php">Projects</a>
      <a href="manage_credentials.php">Credentials</a>
      <a href="manage_contacts.php">Contacts</a>
      <a href="logout.php">Logout</a>
    </nav>
  </header>

  <main>
    <h2>Edit Credential</h2>

    <?php if ($error): ?><p class="error"><?= htmlspecialchars($error) ?></p><?php endif; ?>

    <form method="post">
      <label>Name:</label>
      <input type="text" name="name" value="<?php echo htmlspecialchars($cred['name']); ?>" required>

      <label>Description:</label>
      <textarea name="description" rows="5"><?php echo htmlspecialchars($cred['description']); ?></textarea>

      <label>Image Filename:</label>
      <input type="text" name="image" value="<?php echo htmlspecialchars($cred['image']); ?>">
      <?php if (!empty($cred['image'])): ?>
        <div class="preview">
          <strong>Current Image:</strong><br>
          <img src="../images/<?php echo htmlspecialchars($cred['image']); ?>" alt="Current Image" style="max-width:260px;margin-top:8px;border-radius:6px;border:1px solid #eee;">
        </div>
      <?php endif; ?>

      <button type="submit">Update Credential</button>
    </form>
  </main>

  <script src="../script.js"></script>
</body>
</html>

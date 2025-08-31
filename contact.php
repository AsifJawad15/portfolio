<?php
include 'includes/config.php';

// Handle contact form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $message = trim($_POST['message']);

  if(!empty($name) && !empty($email) && !empty($message)) {
    $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);
    $stmt->execute();
    $stmt->close();
    $successMsg = "Your message has been sent!";
  } else {
    $errorMsg = "Please fill in all fields.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Me</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/cookies.css">
</head>
<body>
  <header class="header">
    <a href="index.php" class="logo">Asif Jawad</a>
    <i class='bx bx-menu' id="menu-icon"></i>
    <nav class="navbar">
      <a href="index.php">Home</a>
      <a href="projects.php">Projects</a>
      <a href="credentials.php">Credential</a>
    </nav>
  </header>

  <main style="flex: 1; margin-top:80px; padding:0 10%;">
    <h2 class="section-title">Contact Me</h2>
    <?php if(isset($successMsg)) echo "<p class='success'>$successMsg</p>"; ?>
    <?php if(isset($errorMsg)) echo "<p class='error'>$errorMsg</p>"; ?>

    <form method="POST" style="max-width:600px;">
      <label>Name:</label>
      <input type="text" name="name" required>

      <label>Email:</label>
      <input type="email" name="email" required>

      <label>Message:</label>
      <textarea name="message" rows="5" required></textarea>

      <button type="submit">Send Message</button>
    </form>
  </main>

  <footer class="footer">
    <div class="social">
      <a href="#"><i class='bx bxl-linkedin'></i></a>
      <a href="#"><i class='bx bxl-github'></i></a>
      <a href="#"><i class='bx bxl-facebook'></i></a>
      <a href="#"><i class='bx bxl-instagram'></i></a>
    </div>
    <p>© 2025 - All Rights Reserved</p>
  </footer>

  <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
  <script src="js/navigation.js"></script>
  <script src="js/cookies.js"></script>
</body>
</html>

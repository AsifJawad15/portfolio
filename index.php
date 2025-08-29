<?php
include 'includes/config.php';
$res = $conn->query("SELECT * FROM skills ORDER BY category, sort_order, id");
$skills_by_cat = [];
while ($r = $res->fetch_assoc()) {
    $skills_by_cat[$r['category']][] = $r;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Portfolio</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- ICONS & STYLESHEET -->
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css?v=1.0.2">
</head>
<body>

  <!-- HEADER / NAVBAR -->
  <header class="header">
    <a href="index.php" class="logo">Asif Jawad</a>
    <i class='bx bx-menu' id="menu-icon"></i>
    <nav class="navbar">
      
      <a href="projects.php">Projects</a>
      <a href="contact.php">Contact</a>
      <a href="credentials.php">Credentials</a>
      <a href="admin/login.php">Admin</a>
    </nav>
  </header>

  <!-- HOME SECTION -->
  <section id="home" class="home">
    <div class="home-img">
      <img src="images/asif.jpg" alt="Profile Image">
    </div>
    <div class="home-content">
      <h3>Hello, I'm</h3>
      <h1>Asif Jawad</h1>
      <h3>And I'm a <span class="multiple-text"></span></h3>
      
      <div class="social-media">
        <a href="https://www.linkedin.com/in/asif-jawad-592461355/" target="_blank"><i class='bx bxl-linkedin'></i></a>
        <a href="https://github.com/AsifJawad15" target="_blank"><i class='bx bxl-github'></i></a>
        <a href="https://www.instagram.com/asif_jawad_jay/" target="_blank"><i class='bx bxl-instagram'></i></a>
        <a href="https://www.facebook.com/asifjawad.aj/" target="_blank"><i class='bx bxl-facebook'></i></a>
      </div>
      <a href="download_resume.php" class="btn">Resume</a>

    </div>
  </section>

  
  <!-- ABOUT SECTION -->
  <section id="about" class="about">
    <h2 class="section-title">About Me</h2>
    <div class="about-content">
      <!-- Left side - Text content -->
      <div class="about-text">
        <p>As a passionate Computer Science and Engineering graduate, I bring a strong foundation in software development, problem-solving, and modern technologies. I thrive on creating innovative solutions that bridge the gap between complex technical challenges and user-friendly applications.</p>
        
        <!-- Email line -->
        <div class="about-email">
          <i class='bx bx-at'></i>
          <span>asifjawadaj15@gmail.com</span>
        </div>

        <!-- Contact Me button -->
        <a href="contact.php" class="about-contact">
          <i class='bx bx-message-square-detail'></i>
          <span>Contact Me</span>
        </a>
      </div>

      <!-- Right side - Photo -->
      <div class="about-image">
        <img class="about-photo" src="images/me.jpg" alt="Asif Jawad">
      </div>
    </div>
  </section>
 <!-- EDUCATION SECTION -->
  <section class="education">
    <h2 class="section-title">Education</h2>
    <div class="education-grid">
      <div class="edu-item"
           data-title="Khulna Zilla School"
           data-period="2009 – 2019">
        School
      </div>
      <div class="edu-item"
           data-title="Govt. M. M. City College"
           data-period="2020 – 2022">
        College
      </div>
      <div class="edu-item"
           data-title="Khulna University of Engineering and Technology"
           data-period="2023 – Ongoing"
           data-dept="Dept. of Computer Science & Engineering">
        University
      </div>
    </div>
  </section>
 <!-- SKILLS SECTION -->
<section id="skills" class="skills">
  <h2 class="section-title">My Skills</h2>
  <div class="skills-content">
    <?php if (empty($skills_by_cat)): ?>
      <p style="text-align:center">No skills added yet.</p>
    <?php else: ?>
      <?php foreach ($skills_by_cat as $category => $items): ?>
        <div class="skill-box">
          <h3><?php echo htmlspecialchars($category); ?></h3>
          <?php foreach ($items as $skill): ?>
            <div class="skill">
              <span><?php echo htmlspecialchars($skill['name']); ?></span>
              <div class="skill-bar">
                <div class="skill-per" data-per="<?php echo (int)$skill['percentage']; ?>%"></div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</section>


  <!-- FOOTER -->
  <footer class="footer">
    <div class="social">
      <a href="https://www.linkedin.com/in/asif-jawad-592461355/" target="_blank"><i class='bx bxl-linkedin'></i></a>
      <a href="https://github.com/AsifJawad15" target="_blank"><i class='bx bxl-github'></i></a>
      <a href="https://www.instagram.com/asif_jawad_jay/" target="_blank"><i class='bx bxl-instagram'></i></a>
      <a href="https://www.facebook.com/asifjawad.aj/" target="_blank"><i class='bx bxl-facebook'></i></a>
    </div>
    <p>© 2025 - All Rights Reserved</p>
  </footer>

  <!-- SCRIPTS -->
  <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
  <script src="script.js?v=1.0.2"></script>
</body>
</html>

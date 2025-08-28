<header class="header">
  <a href="dashboard.php" class="logo">Admin Panel</a>
  <i class='bx bx-menu' id="menu-icon"></i>
  <nav class="navbar">
    <a href="manage_projects.php">Projects</a>
    <a href="manage_skills.php">Skills</a>
    <a href="manage_credentials.php">Credentials</a>
    <a href="manage_contacts.php">Contacts</a>
    <a href="logout.php">Logout</a>
  </nav>
</header>
<style>
.header { position: fixed; top:0; width:100%; background:#2d2d2d; padding:10px 10%; display:flex; justify-content:space-between; align-items:center; z-index:999; border-bottom: 1px solid #444; }
.header .logo { color:#B5A8D5; font-size:1.2rem; text-decoration:none; font-weight:700 }
.header .navbar a { color:#e0e0e0; text-decoration:none; margin-left:24px; font-size:0.95rem }
.header .navbar a:hover { color:#B5A8D5; }
#menu-icon { font-size:1.8rem; color:#e0e0e0; cursor:pointer; display:none }
@media (max-width:768px) { #menu-icon{display:block} .navbar{display:none} .navbar.active{display:block; position:absolute; top:60px; left:0; width:100%; background:#2d2d2d; padding:20px 0; text-align:center; border-bottom: 1px solid #444;} .navbar.active a{display:block; margin:10px 0} }
.admin-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(180px,1fr)); gap:18px; margin-top:20px }
.admin-card { background:#2d2d2d; border-radius:10px; padding:18px; text-align:center; box-shadow:0 6px 20px rgba(0,0,0,0.15); transition:transform .15s; cursor:pointer; border: 1px solid #444; }
.admin-card:hover { transform:translateY(-4px); background:#3d3d3d; }
.admin-card .icon { font-size:2.2rem; color:#B5A8D5; margin-bottom:8px }
.admin-card .count { font-size:1.6rem; margin-top:6px; color:#e0e0e0 }
</style>

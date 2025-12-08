<?php
session_start();
require_once "protected/config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Riot Simulator</title>
  <link rel="stylesheet" href="assets/style.css">
  <script defer src="assets/script.js"></script>
</head>

<body>
  <header>
    <nav class="nav-bar">

      <div class="nav-left">
        <a href="index.php">Home</a>
        <a href="play.php">Play</a>
        <a href="info.php">Info</a>
        <a href="credits.php">Credits</a>
      </div>

      <?php if (isset($_SESSION['user_id'])): ?>
        <div class="nav-right">
          <span>Logged in: <?= htmlspecialchars($_SESSION['username']) ?></span>
          <a href="logout.php" class="login-btn">Logout</a>
        </div>
      <?php else: ?>
        <div class="nav-right">
          <a href="login.php" class="login-btn">Login</a>
        </div>
      <?php endif; ?>
    </nav>
  </header>


  <section class="banner">
    <div class="banner-content">
      <h2>Riot Game Simulator</h2>
      <p class="banner-subtitle">Survive waves of cops</p>
      <a href="play.php" class="banner-button">▶ Play Now</a>
    </div>
  </section>

  <main class="home-main">
    <section class="updates-section">
      <h2>Latest Updates</h2>
      <div class="updates-container">
        <div class="update-card">
          <div class="update-date">Nov 24, 2025</div>
          <h3>Version 1.1 - Initial Release</h3>
          <ul>
            <li>Improved Gameplay</li>
            <li>Login System</li>
            <li>???</li>
            <li>???</li>
          </ul>
        </div>
        <div class="update-card">
          <div class="update-date">Oct 6, 2025</div>
          <h3>Version 1.0 - Initial Release</h3>
          <ul>
            <li>Playable character</li>
            <li>Basic controls (WASD + Space)</li>
            <li>Timer + Health Bar</li>
            <li>First enemies implemented</li>
          </ul>
        </div>
      </div>
    </section>
  </main>

  <footer>
    <p>© 2025 JavZolSta EKCU DevOps</p>
  </footer>
</body>

</html>

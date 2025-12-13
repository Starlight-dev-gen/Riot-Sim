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
        <a href="leaderboard.php">Leaderboard</a>
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

    <main>
        <h2>Development Team</h2>

        <div style="max-width: 800px; margin: 0 auto;">
            <section class="content-section">
                <p style="color: #666; margin-bottom: 2rem;">
                    Riot Simulator was created by a team Computer Science students from Eszterházy Károly Catholic
                    University.
                </p>

                <div class="team-grid">
                    <div class="team-card">
                        <h4>Castillo-Weigert Javier Ákos</h4>
                        <p>Computer Science Student</p>
                        <p>Game development, mechanics, and programming</p>
                    </div>

                    <div class="team-card">
                        <h4>Patkovics Zoltán</h4>
                        <p>Computer Science Student</p>
                        <p>Frontend development and testing</p>
                    </div>

                    <div class="team-card">
                        <h4>Turkevi-Nagy Hunor</h4>
                        <p>Computer Science Student</p>
                        <p>Game development, mechanics, programming, art and assets</p>
                    </div>
                </div>
            </section>

            <section class="content-section">
                <h3>Project Information</h3>
                <p><strong>Team:</strong> JavZolSta EKCU DevOps</p>
                <p><strong>Year:</strong> 2025</p>
                <p><strong>Game Engine:</strong> Godot</p>
            </section>

            <section class="content-section">
                <h3>Special Thanks</h3>
                <li>The Godot community for excellent documentation</li>
                <li>Apró Anikó for guidance and support</li>
                </ul>
            </section>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 JavZolSta EKCU DevOps</p>
    </footer>
</body>

</html>

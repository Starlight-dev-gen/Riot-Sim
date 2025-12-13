<?php
session_start();
require_once "protected/config.php";

// Fetch top 10 times
$stmt = $pdo->query("
    SELECT u.username, us.time, us.created_at
    FROM user_scores us
    JOIN users u ON us.user_id = u.id
    ORDER BY us.time DESC
    LIMIT 10
");

$scores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Leaderboard | Riot Simulator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
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
        <section class="section">
            <h2 style="text-align: center;">🏆 Top 10 Escapists</h2>

            <table class="controls">
                <caption>Leaderboard</caption>
                <thead>
                    <tr>
                        <th style="text-align: left;">#</th>
                        <th style="text-align: left;">Player</th>
                        <th style="text-align: left;">Survived for</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($scores)): ?>
                        <tr>
                            <td colspan="3" class="center">No runs recorded yet.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($scores as $index => $row): ?>
                            <tr>
                                <td><strong><?= $index + 1 ?></strong></td>
                                <td><?= htmlspecialchars($row['username']) ?></td>
                                <td><?= number_format($row['time'], 2) ?>s</td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 JavZolSta EKCU DevOps</p>
    </footer>

</body>

</html>
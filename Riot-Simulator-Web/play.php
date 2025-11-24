<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,">
  <title>Riot Simulator</title>
  <link rel="stylesheet" href="assets/style.css">
  <script src="assets/script.js"></script>

</head>

<body>
  <header>
    <nav>
      <a href="index.php">Home</a>
      <a href="play.php">Play</a>
      <a href="info.php">Info</a>
      <a href="credits.php">Credits</a>
    </nav>
  </header>

  <main>
    <div class="game-wrapper">

      <div class="game-container">
        <iframe id="game-frame" src="game/RiotSim/RiotSim.html" allowfullscreen>
        </iframe>
      </div>

      <div class="game-controls">
        <button id="fullscreen-btn" class="button">Fullscreen (F)</button>
        <button id="reload-btn" class="button">Reload Game (R)</button>
      </div>

    </div>

    <table class="controls">
      <caption>Default Controls</caption>
      <tr>
        <td><strong>Move</strong></td>
        <td>WASD</td>
      </tr>
    </table>

  </main>

  <footer>
    <p>&copy; 2025 JavZolSta EKCU DevOps</p>
  </footer>
</body>

<script>
  const iframe = document.getElementById("game-frame");
  const fullscreenBtn = document.getElementById("fullscreen-btn");
  const reloadBtn = document.getElementById("reload-btn");

  function goFullscreen() {
    if (iframe.requestFullscreen) iframe.requestFullscreen();
    else if (iframe.webkitRequestFullscreen) iframe.webkitRequestFullscreen();
    else if (iframe.msRequestFullscreen) iframe.msRequestFullscreen();
  }

  fullscreenBtn.addEventListener("click", goFullscreen);


  reloadBtn.addEventListener('click', () => {
    iframe.src = iframe.src;
  });

  document.addEventListener("keydown", e => {
    const key = e.key.toLowerCase();
    if (key === "f") goFullscreen();
    if (key === "r") iframe.src = iframe.src;
  });

  // Fix canvas scaling in fullscreen
  document.addEventListener("fullscreenchange", () => {
    try {
      const doc = iframe.contentDocument || iframe.contentWindow.document;
      const canvas = doc.querySelector("canvas");
      if (!canvas) return;

      const isFullscreen = document.fullscreenElement === iframe;
      canvas.style.width = isFullscreen ? "100vw" : "";
      canvas.style.height = isFullscreen ? "100vh" : "";
      canvas.style.objectFit = isFullscreen ? "contain" : "";
    } catch { }
  });

  document.addEventListener('fullscreenchange', () => {
    const isFs = document.fullscreenElement === iframe;
    resizeCanvasInIframe(isFs);
  });
</script>

</html>
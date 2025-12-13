The contents of Godot's web export should go into main directory inside here.
The reason it is not here is because git can't upload the .wasm file so you're gonna have to do it manually
1. It should contain the following to work!!
- RiotSim.html
- RiotSim.js
- RiotSim.pck
- RiotSim.wasm

2. It needs to have in RiotSim.html for the database save!!!
function saveScoreToServer(time) {
      fetch("save_score.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded"
          },
          body: new URLSearchParams({
            time
          })
        })
        .then(r => r.json())
        .then(data => console.log("Score saved:", data))
        .catch(err => console.error("Save error:", err));
    }
    window.saveScoreToServer = saveScoreToServer;

If it loads but shows a black screen, update your browser's WebGL
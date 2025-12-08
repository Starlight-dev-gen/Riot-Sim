<?php
session_start();
require_once "protected/config.php";

$db = new Database();
$pdo = $db->getConnection();

$error = '';

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if(empty($email) || empty($password)) {
        $error = "ERROR: All fields must be filled!";
    } else {

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Note: I know how to hash inside but idk how to unhash so we'll use raw text for now.
        if($user && $password === $user['password']) {

            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["username"];
            $_SESSION["role"] = $user["role"];

            header("Location: index.php");
            exit();
        } else {
            $error = "ERROR: Wrong E-mail or Password!";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>
<link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <div class="auth-form">
        <h2>Login</h2>

        <?php if($error): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="POST">
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="password" placeholder="Password" required>
            <button class="button" type="submit">Login</button>
        </form>

        <p>No account? <a href="register.php">Register here!</a></p>
        <a href="index.php" class="button">Back to main page</a>
    </div>
</body>
</html>

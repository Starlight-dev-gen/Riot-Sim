<?php
session_start();
require_once "protected/config.php";

$db = new Database();
$pdo = $db->getConnection();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm = trim($_POST['confirm_password']);

    if (empty($username) || empty($email) || empty($password) || empty($confirm))
        $errors[] = "ERROR: All fields are required!";

    if ($password !== $confirm)
        $errors[] = "ERROR: Passwords do not match!";

    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        $errors[] = "ERROR: Invalid email format!";

    // check existing
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $email]);
    if ($stmt->fetch())
        $errors[] = "ERROR: Username or E-mail already taken!";

    if (empty($errors)) {

        // plain text password storage (your request)
        $stmt = $pdo->prepare("
            INSERT INTO users (username, email, password, role)
            VALUES (?, ?, ?, 'user')
        ");

        if ($stmt->execute([$username, $email, $password])) {

            $_SESSION['registered'] = true;
            header("Location: login.php");
            exit();

        } else {
            $errors[] = "ERROR: Unexpected database error!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <div class="auth-form">
        <h2>Register</h2>

        <?php if ($errors): ?>
            <div class="error-messages">
                <?php foreach ($errors as $e): ?>
                    <p class="error"><?= htmlspecialchars($e) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <input type="text" name="username" placeholder="Username"
                value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required>

            <input type="email" name="email" placeholder="E-mail" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                required>

            <input type="password" name="password" placeholder="Password" required>

            <input type="password" name="confirm_password" placeholder="Confirm Password" required>

            <button type="submit" class="button">Register</button>
        </form>

        <p>Already registered? <a href="login.php">Login here</a></p>
        <a href="index.php" class="button">Back to main page</a>
    </div>
</body>

</html>
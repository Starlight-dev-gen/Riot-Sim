<?php
session_start();
require_once "protected/config.php";

header("Content-Type: application/json");

// ALWAYS return JSON
$response = [];

// Check login
if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        "error" => "Not logged in"
    ]);
    exit;
}

// Validate input
if (!isset($_POST['time'])) {
    echo json_encode([
        "error" => "Missing time value"
    ]);
    exit;
}

$user_id = $_SESSION['user_id'];
$time = floatval($_POST['time']);

try {
    $db = new Database();
    $pdo = $db->getConnection();

    $sql = "
        INSERT INTO user_scores (user_id, time)
        VALUES (:user_id, :time)
        ON DUPLICATE KEY UPDATE
            time = IF(:time > time, :time, time)
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':user_id' => $user_id,
        ':time' => $time
    ]);

    echo json_encode([
        "success" => true,
        "saved_time" => $time
    ]);
} catch (PDOException $e) {
    echo json_encode([
        "error" => $e->getMessage()
    ]);
}

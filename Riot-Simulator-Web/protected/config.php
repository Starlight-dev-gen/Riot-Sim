<?php 
session_start();

// Error handling while development
error_reporting(E_ALL);
ini_set('display_errors',1);

// Database Connection
class Database {
    private $host = "localhost";
    private $db_name = "task_manager";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->exec("set names utf8");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
                echo "Connection error: " . $exception->getMessage(); // Only here for the development
        }
        return $this->conn;
    }
}

/*
Will be initializing classes and the necessary queries here later for 
the login system and the query for listing top 10 scores for the leaderboard
*/

// Initializing session variables
if(!isset($_SESSION['active_timer'])) {
    $_SESSION['active_timer'] = null;
    $_SESSION['timer_start'] = null;
}
?>
<?php
require_once 'connection.php';
session_start();
$db = Database::getInstance();
$conn = $db->getConnection();

if (!isset($_SESSION['id'])) {
    header("Location: inloggen.php");
    exit();
}
$current_id = $_SESSION['id'];
$username = $_POST['username'] ?? 0;
if (isset($username)) {
    // Zet de vriendschap op accepted = 1
    $stmt = $conn->prepare("UPDATE vrienden SET accepted = 1 WHERE vrienden_id = :current_id AND username = :username");
    $stmt->bindParam(':current_id', $current_id, PDO::PARAM_INT);
    $stmt->bindParam(':username', $username, PDO::PARAM_INT);
    $stmt->execute();

header("Location: vriendenlijst.php");
}
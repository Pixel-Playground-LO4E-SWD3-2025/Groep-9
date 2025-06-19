<?php
require_once 'connection.php';
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: inloggen.php");
    exit();
}

$current_id = $_SESSION['id'];
$vrienden_id = $_POST['id'] ?? 0;

if ($gebruiker_id) {
    // Zet de vriendschap op accepted = 1
    $stmt = $conn->prepare("UPDATE vrienden SET accepted = 1 WHERE gebruiker_id = :gebruiker_id AND vrienden_id = :current_id");
    $stmt->bindParam(':vrienden_id', $vrienden_id, PDO::PARAM_INT);
    $stmt->bindParam(':current_id', $current_id, PDO::PARAM_INT);
    $stmt->execute();
}

header("Location: vriendenvoegen.php");
exit();
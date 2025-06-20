<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="hier kun je vriendschappen accepteren of afwijzen. Beheer je sociale netwerk door vriendschapsverzoeken te accepteren of te weigeren.">
    <meta name="keywords" content="accept, afwijzen, vriendschap, social, network, game, vrienden, wijzigen">
    <meta name="author" content="raay">
    <title>Home</title>
</head>
<body>
    
</body>
</html>

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
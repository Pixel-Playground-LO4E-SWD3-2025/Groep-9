<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="hier kun je vrienden verwijderen uit je sociale netwerk. Selecteer een vriend en verwijder de vriendschap.">
    <meta name="keywords" content="verwijder, vriend, social, network, game">
    <meta name="author" content="raay">
    <title>verwijder</title>
</head>
<body>
    
</body>
</html>

<?php
session_start();
require_once 'connection.php';
$db = Database::getInstance();
$conn = $db->getConnection();
if (!isset($_SESSION['id'])) {
    header("Location: inloggen.php");
    exit();
}

$huidige_gebruiker_id = $_SESSION['id'];
$vriend_id = $_POST['vriend_id'] ?? 0;

if ($vriend_id) {
    // Verwijder de vriendschap, ongeacht wie wie heeft toegevoegd
    $verwijder_query = $conn->prepare(
        "DELETE FROM vrienden 
         WHERE (gebruiker_id = :huidige_gebruiker_id AND vrienden_id = :vriend_id)
            OR (gebruiker_id = :vriend_id AND vrienden_id = :huidige_gebruiker_id)"
    );
    $verwijder_query->bindParam(':huidige_gebruiker_id', $huidige_gebruiker_id, PDO::PARAM_INT);
    $verwijder_query->bindParam(':vriend_id', $vriend_id, PDO::PARAM_INT);
    $verwijder_query->execute();
}

header("Location: vriendenlijst.php");
exit();
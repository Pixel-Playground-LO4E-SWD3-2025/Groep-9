<?php
session_start();
require_once 'connection.php';

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
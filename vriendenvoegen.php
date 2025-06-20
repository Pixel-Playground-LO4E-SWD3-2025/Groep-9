<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="hier kun je vrienden toevoegen aan je sociale netwerk. Zoek naar gebruikers en stuur vriendschapsverzoeken om verbinding te maken met anderen in het spel.">
    <meta name="keywords" content="vriend, add, request, social, network, game">
    <meta name="author" content="raay">
    <title>verzoek</title>
</head>
<body>
    
</body>
</html>

<?php
require_once 'connection.php'; 
$db = Database::getInstance();
$conn = $db->getConnection();
session_start();

if (isset($_POST['vrienden_id']))
    echo "<p>Gebruiker gevonden!</p>";  
{
    $current_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    $vrienden_id = $_POST['vrienden_id'];
    try{
    $checkStmt = $conn->prepare("SELECT COUNT(*) FROM vrienden WHERE gebruiker_id = :id AND vrienden_id = :vrienden_id");
    $checkStmt->bindParam(':id', $current_id);
    $checkStmt->bindParam(':vrienden_id', $vrienden_id);
    $checkStmt->execute();
    $exists = $checkStmt->fetchColumn();
    } catch (PDOException $e) {
        echo "<p>Fout bij het controleren van vriendschap: " . htmlspecialchars($e->getMessage()) . "</p>";
        exit();
    }

    if ($current_id && $vrienden_id) {
        if ($exists) {
            echo "<p>Je hebt deze gebruiker al als vriend toegevoegd of er is al een verzoek.</p>";
                            header("Location: vriendenlijst.php");
        } else {
            try {
                $accepted = 0;
                $stmt = $conn->prepare("INSERT INTO vrienden (gebruiker_id, vrienden_id, username, accepted) VALUES (:id, :vrienden_id, :username, :accepted)");
                $stmt->bindParam(':id', $current_id);
                $stmt->bindParam(':vrienden_id', $vrienden_id);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':accepted', $accepted);
                $stmt->execute();

                echo "<p>Vriend succesvol toegevoegd!</p>";
                header("Location: vriendenlijst.php");
            } catch (PDOException $e) {
                echo "<p>Fout bij het toevoegen van vriend: " . htmlspecialchars($e->getMessage()) . "</p>";
            }
        }
    } else {
        echo "<p>Ongeldige gebruikersgegevens.</p>";
    }
}
?>
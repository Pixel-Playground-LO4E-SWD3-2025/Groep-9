
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="hier kun je je highscore opslaan in onze sociale netwerk game. Sla je scores op en vergelijk ze met vrienden.">
    <meta name="keywords" content="opslaan, highscore, game, social, network">
    <meta name="author" content="raay">
    <title>Home</title>
</head>
<body>
    
</body>
</html>
<?php
require 'connection.php';
session_start();

$db = Database::getInstance();
$conn = $db->getConnection();

// Controleer of de gebruiker is ingelogd, anders anoniem
if (isset($_SESSION['id']) && isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    $userId = $_SESSION['id'];
    $username = $_SESSION['username'];
} else {
    $userId = null;
    $username = 'anoniem';
}

// Haal de ruwe POST data op
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['highscore']) && isset($data['gamename'])) {
    $newScore = $data['highscore'];
    $gameName = $data['gamename'];

    try {
        // Zoek bestaande highscore (let op: IS NULL voor anoniem)
        if ($userId === null) {
            $stmt = $conn->prepare("SELECT score FROM highscores WHERE user_id IS NULL AND game_name = :game_name AND username = 'anoniem'");
        } else {
            $stmt = $conn->prepare("SELECT score FROM highscores WHERE user_id = :user_id AND game_name = :game_name");
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        }
        $stmt->bindParam(':game_name', $gameName, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            // Insert nieuwe highscore
            if ($userId === null) {
                $stmt = $conn->prepare("INSERT INTO highscores (user_id, game_name, username, score) VALUES (NULL, :game_name, :username, :score)");
            } else {
                $stmt = $conn->prepare("INSERT INTO highscores (user_id, game_name, username, score) VALUES (:user_id, :game_name, :username, :score)");
                $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            }
            $stmt->bindParam(':game_name', $gameName, PDO::PARAM_STR);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':score', $newScore, PDO::PARAM_INT);
            $stmt->execute();
            echo "Highscore opgeslagen!";
        } elseif ($newScore > $row['score']) {
            // Update alleen als de nieuwe score hoger is
            if ($userId === null) {
                $stmt = $conn->prepare("UPDATE highscores SET score = :score WHERE user_id IS NULL AND game_name = :game_name AND username = 'anoniem'");
            } else {
                $stmt = $conn->prepare("UPDATE highscores SET score = :score WHERE user_id = :user_id AND game_name = :game_name");
                $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            }
            $stmt->bindParam(':score', $newScore, PDO::PARAM_INT);
            $stmt->bindParam(':game_name', $gameName, PDO::PARAM_STR);
            $stmt->execute();
            echo "Highscore geüpdatet!";
        } else {
            echo "Highscore niet hoger dan vorige.";
        }
    } catch (PDOException $e) {
        echo "Fout: " . $e->getMessage();
    }
} else {
    echo "Ongeldige data ontvangen.";
}
<?php
require 'connection.php';
session_start();

$db = Database::getInstance();
$conn = $db->getConnection();

if (!isset($_SESSION['id']) || !isset($_SESSION['username'])) {
    echo "Niet ingelogd!";
    exit;
}

$userId = $_SESSION['id'];
$username = $_SESSION['username'];

// Haal de ruwe POST data op
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['highscore']) && isset($data['gamename'])) {
    $newScore = $data['highscore'];
    $gameName = $data['gamename'];

    try {
        // Kijk of er al een highscore is voor deze user en dit spel
        $stmt = $conn->prepare("SELECT score FROM highscores WHERE user_id = :user_id AND game_name = :game_name");
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':game_name', $gameName, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            // Nog geen highscore, dus insert
            $stmt = $conn->prepare("INSERT INTO highscores (user_id, game_name, username, score) VALUES (:user_id, :game_name, :username, :score)");
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':game_name', $gameName, PDO::PARAM_STR);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':score', $newScore, PDO::PARAM_INT);
            $stmt->execute();
            echo "Highscore opgeslagen!";
        } elseif ($newScore > $row['score']) {
            // Alleen updaten als de nieuwe score hoger is
            $stmt = $conn->prepare("UPDATE highscores SET score = :score WHERE user_id = :user_id AND game_name = :game_name");
            $stmt->bindParam(':score', $newScore, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
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
?>
<?php
require_once 'connection.php';
require_once 'header.php';

$db = Database::getInstance();
$conn = $db->getConnection();

if (!isset($_POST['vriend_id'])) {
    echo "<p class='vriendenlijst'>Geen vriend geselecteerd.</p>";
    exit();
}

$vriend_id = $_POST['vriend_id'];

// Haal de gebruikersnaam en highscore op van de geselecteerde vriend
$stmt = $conn->prepare("SELECT username, game_name, score FROM highscores WHERE user_id = :vriend_id");
$stmt->bindParam(':vriend_id', $vriend_id, PDO::PARAM_INT);
$stmt->execute();

$vriend = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Highscore van vriend</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <video class="skycolor" autoplay loop muted src="video/Skycolor.mp4"></video>
    
<section class="vriendenlijst-container">
    <?php if ($vriend && count($vriend) > 0): ?>
        <h2>Highscores van <?= htmlspecialchars($vriend[0]['username']) ?></h2>
<ul class="highscore-flex">
    <?php foreach ($vriend as $score): ?>
        <li>
            <span><?= htmlspecialchars($score['game_name']) ?></span>
            <span><strong><?= htmlspecialchars($score['score']) ?></strong></span>
        </li>
    <?php endforeach; ?>
</ul>
    <?php else: ?>
        <p class="vriendenlijst">Vriend niet gevonden.</p>
    <?php endif; ?>
    <a href="vriendenlijst.php">
        <button type="button">Terug naar vriendenlijst</button>
    </a>
</section>
</section>
</body>
</html>
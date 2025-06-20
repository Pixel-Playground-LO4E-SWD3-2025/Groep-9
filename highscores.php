
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="hier vind je de highscores van verschillende games. Bekijk de top scores en vergelijk jouw score met die van anderen.">
    <meta name="keywords" content="highscores, games, leaderboard, scores, gaming, online games, high scores, top scores, gaming community">
    <meta name="author" content="raay">
    <title>Highscores</title>
</head>
<body>
    
</body>
</html>
<?php
require_once 'header.php';
require_once 'connection.php';

$db = Database::getInstance();
$conn = $db->getConnection();

// Haal alle unieke games op
$games = $conn->query("SELECT DISTINCT game_name FROM highscores")->fetchAll(PDO::FETCH_COLUMN);

// Check of er op een game is geklikt
$selected_game = $_GET['game'] ?? null;
?>
<body>
<main>
    <section class="highscores-container">
        <video class="skycolor" autoplay loop muted src="video/Skycolor.mp4"></video>
        <article class="highscores-scoreboard">
            <h1 class="highscores-title">Highscores</h1>
            <?php if ($selected_game && in_array($selected_game, $games)): ?>
                <h2 class="highscores-game-title"><?= htmlspecialchars($selected_game) ?> - Alle highscores</h2>
                <ul class="highscores-table">
                    <li class="highscores-header">
                        <span>Naam</span>
                        <span>Game</span>
                        <span>Score</span>
                    </li>
                    <?php
                    $stmt = $conn->prepare("SELECT username, score FROM highscores WHERE game_name = :game ORDER BY score DESC");
                    $stmt->bindParam(':game', $selected_game, PDO::PARAM_STR);
                    $stmt->execute();
                    $scores = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($scores as $row):
                        $naam = $row['username'] ? htmlspecialchars($row['username']) : 'anoniem';
                    ?>
                        <li class="highscores-row">
                            <span><?= $naam ?></span>
                            <span><?= htmlspecialchars($selected_game) ?></span>
                            <span><strong><?= htmlspecialchars($row['score']) ?></strong></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <a href="highscores.php"><button class="highscores-btn">Terug naar overzicht</button></a>
            <?php else: ?>
                <?php foreach ($games as $game): ?>
                    <h2 class="highscores-game-title" style="margin-top:32px;">
                        <a href="highscores.php?game=<?= urlencode($game) ?>" style="text-decoration:none;color:inherit;">
                            <?= htmlspecialchars($game) ?>
                        </a>
                    </h2>
                    <ul class="highscores-table">
                        <li class="highscores-header">
                            <span>Naam</span>
                            <span>Game</span>
                            <span>Score</span>
                        </li>
                        <?php
                        $stmt = $conn->prepare("SELECT username, score FROM highscores WHERE game_name = :game ORDER BY score DESC LIMIT 5");
                        $stmt->bindParam(':game', $game, PDO::PARAM_STR);
                        $stmt->execute();
                        $scores = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($scores as $row):
                            $naam = $row['username'] ? htmlspecialchars($row['username']) : 'anoniem';
                        ?>
                            <li class="highscores-row">
                                <span><?= $naam ?></span>
                                <span><?= htmlspecialchars($game) ?></span>
                                <span><strong><?= htmlspecialchars($row['score']) ?></strong></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endforeach; ?>
            <?php endif; ?>
        </article>
    </section>
</main>
</body>
<?php require_once 'footer.php'; ?>
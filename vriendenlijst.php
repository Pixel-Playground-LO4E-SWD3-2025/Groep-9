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

// Haal alle geaccepteerde vrienden op (waar jij gebruiker of vriend bent)
$query = $conn->prepare(
    "SELECT gebruikersnaam.username, 
            CASE 
                WHEN vrienden.gebruiker_id = :huidige_gebruiker_id THEN vrienden.vrienden_id 
                ELSE vrienden.gebruiker_id 
            END AS vriend_id
     FROM vrienden
     JOIN users AS gebruikersnaam ON gebruikersnaam.id = CASE 
                                WHEN vrienden.gebruiker_id = :huidige_gebruiker_id THEN vrienden.vrienden_id 
                                ELSE vrienden.gebruiker_id 
                            END
     WHERE vrienden.accepted = 1 
       AND (vrienden.gebruiker_id = :huidige_gebruiker_id OR vrienden.vrienden_id = :huidige_gebruiker_id)"
);
$query->bindParam(':huidige_gebruiker_id', $huidige_gebruiker_id, PDO::PARAM_INT);
$query->execute();
$vrienden_lijst = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Geaccepteerde vrienden</title>
    <link rel="stylesheet" href="css/style.css">
     <video class="skycolor" autoplay loop muted src = "video/Skycolor.mp4"></video>
</head>
<body>
<section class="vriendenlijst-container">
    <h2>Jouw vrienden</h2>
    <a href="vrienden_toevoegen.php">
        <button type="button">Vriend toevoegen</button>
    </a>
    <?php if (count($vrienden_lijst) > 0): ?>
        <ul class="vriendenlijst">
            <?php foreach ($vrienden_lijst as $vriend): ?>
                <li>
                    <?= htmlspecialchars($vriend['username']) ?>
                    <form action="vriend_highscore.php" method="POST" style="display:inline;">
                        <input type="hidden" name="vriend_id" value="<?= $vriend['vriend_id'] ?>">
                        <button type="submit">Bekijk highscore</button>
                    </form>
                    <form action="verwijdervriend.php" method="POST" style="display:inline;">
                        <input type="hidden" name="vriend_id" value="<?= $vriend['vriend_id'] ?>">
                        <button type="submit" onclick="return confirm('Weet je zeker dat je deze vriend wilt verwijderen?');">Verwijder</button>
                    </form>
                    
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Je hebt nog geen vrienden geaccepteerd.</p>
    <?php endif; ?>
    </section>
</body>
</html>
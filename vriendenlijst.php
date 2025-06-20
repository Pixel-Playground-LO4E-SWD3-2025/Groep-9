<?php
session_start();
require_once 'connection.php';
require_once 'header.php';
$db = Database::getInstance();
$conn = $db->getConnection();

if (!isset($_SESSION['id'])) {
    header("Location: inloggen.php");
    exit();
}

$huidige_gebruiker_id = $_SESSION['id'];

$zoek = $_GET['zoek'] ?? '';
if ($zoek !== '') {
    $zoekterm = '%' . $zoek . '%';
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
           AND (vrienden.gebruiker_id = :huidige_gebruiker_id OR vrienden.vrienden_id = :huidige_gebruiker_id)
           AND gebruikersnaam.username LIKE :zoekterm"
    );
    $query->bindParam(':huidige_gebruiker_id', $huidige_gebruiker_id, PDO::PARAM_INT);
    $query->bindParam(':zoekterm', $zoekterm, PDO::PARAM_STR);
} else {
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
}
$query->execute();
$vrienden_lijst = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="hier vind je jouw vriendenlijst. Voeg vrienden toe, bekijk hun high scores en verwijder vrienden indien nodig.">
    <meta name="keywords" content="vriendenlijst, vrienden toevoegen, vrienden verwijderen, high scores, gaming community, online games, vrienden beheren">
    <meta name="author" content="raay">
    <title>vriendenlijst</title>
    <link rel="stylesheet" href="css/style.css">
    <video class="skycolor" autoplay loop muted src="video/Skycolor.mp4"></video>
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

    <form class="vrienden-zoek-form" method="GET" action="">
        <input type="text" name="zoek" placeholder="Zoek vriend..." value="<?= isset($_GET['zoek']) ? htmlspecialchars($_GET['zoek']) : '' ?>">
        <button type="submit">Zoeken</button>
    </form>
</section>
<?php require_once 'footer.php'; ?>
</body>
</html>
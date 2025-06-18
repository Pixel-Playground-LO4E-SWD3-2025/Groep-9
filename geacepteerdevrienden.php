<?php

session_start();
require_once 'connection.php';

if (!isset($_SESSION['id'])) {
    header("Location: inloggen.php");
    exit();
}

$current_id = $_SESSION['id'];

// Haal alle geaccepteerde vrienden op (waar jij gebruiker of vriend bent)
$stmt = $conn->prepare("SELECT * FROM vrienden WHERE gebruiker_id = :id AND accepted AND (gebruiker_id != vrienden_id)"
=
);
$stmt->bindParam(':id', $current_id, PDO::PARAM_INT);
$stmt->execute();
$vrienden = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Geaccepteerde vrienden</title>
</head>
<body>
    <h2>Jouw vrienden</h2>
    <?php if (count($vrienden) > 0): ?>
        <ul>
            <?php foreach ($vrienden as $vriend): ?>
                <li><?= htmlspecialchars($vriend['username']) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Je hebt nog geen vrienden geaccepteerd.</p>
    <?php endif; ?>
</body>
</html>
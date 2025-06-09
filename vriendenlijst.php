<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['naam'])) {
    $naam = $_POST['naam'];
    $stmt = $conn->prepare("INSERT INTO vrienden (naam) VALUES (:naam)");
    $stmt->bindParam(':naam', $naam);
    $stmt->execute();
}

$result = $conn->query("SELECT * FROM vrienden ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Vriendenlijst</title>
</head>
<body>
    <h2>Vriendenlijst</h2>
    <form method="post">
        <input type="text" name="naam" placeholder="Naam van vriend" required>
        <button type="submit">Toevoegen</button>
    </form>
    <ul>
        <?php while($row = $result->fetch()): ?>
            <li><?= htmlspecialchars($row->naam) ?></li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
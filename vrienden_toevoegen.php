<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="hier kun je vrienden toevoegen aan je sociale netwerk. Zoek naar gebruikers en stuur vriendschapsverzoeken om verbinding te maken met anderen in het spel.">
    <meta name="keywords" content="vriend, add, request, social, network, game">
    <meta name="author" content="raay">
    <title>Toevoegen</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
require_once 'connection.php';
require_once 'header.php';
$db = Database::getInstance();
$conn = $db->getConnection();
$current_id = $_SESSION['id'] ?? 0;

echo '<form class="vrienden-zoek-form" method="GET" action="">
    <input type="text" name="zoek" placeholder="Zoek gebruiker..." value="' . (isset($_GET['zoek']) ? htmlspecialchars($_GET['zoek']) : '') . '">
    <button type="submit">Zoeken</button>
</form>';
try {
$stmt = $conn->prepare("SELECT v.*, u.username FROM vrienden v JOIN users u ON v.gebruiker_id = u.id WHERE v.vrienden_id = :id AND v.accepted = 0");
$stmt->bindParam(':id', $current_id, PDO::PARAM_INT);
$stmt->execute();
$verzoeken = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<p>Fout bij het ophalen van vriendschapsverzoeken: " . htmlspecialchars($e->getMessage()) . "</p>";
}

if (count($verzoeken) > 0) {
    echo "<h3>Vriendschapsverzoeken:</h3><ul class='vriendenlijst'>";
    foreach ($verzoeken as $verzoek) {
        echo "<li>";
        echo htmlspecialchars($verzoek['username']) . " wil vrienden worden.";
        echo "
            <form action='acceptatie_wijzigen.php' method='POST' style='display:inline;'>
                <input type='hidden' name='username' value='" . htmlspecialchars($verzoek['username']) . "'>
                <button type='submit'>Accepteer</button>
            </form>
            <form action='vriendafwijzen.php' method='POST' style='display:inline;'>
                <input type='hidden' name='username' value='" . htmlspecialchars($verzoek['username']) . "'>
                <button type='submit'>Afwijzen</button>
            </form>
        ";
        echo "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>Je hebt geen nieuwe vriendschapsverzoeken.</p>";
}

$zoek = $_GET['zoek'] ?? '';
if ($zoek !== '') {
    $zoekterm = '%' . $zoek . '%';
    $stmt = $conn->prepare("SELECT id, username FROM users WHERE id != :current_id AND username LIKE :zoekterm");
    $stmt->bindParam(':current_id', $current_id, PDO::PARAM_INT);
    $stmt->bindParam(':zoekterm', $zoekterm, PDO::PARAM_STR);
} else {
    $stmt = $conn->prepare("SELECT id, username FROM users WHERE id != :current_id");
    $stmt->bindParam(':current_id', $current_id, PDO::PARAM_INT);
}
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<h3>Alle gebruikers:</h3><ul class='vriendenlijst'>";
foreach ($users as $user) {
    echo "<li>";
    echo htmlspecialchars($user['username']);
    echo "
        <form action='vriendenvoegen.php' method='POST' style='display:inline;'>
            <input type='hidden' name='vrienden_id' value='" . htmlspecialchars($user['id']) . "'>
            <button type='submit'>Vriend toevoegen</button>
        </form>
    ";
    echo "</li>";
}
echo "</ul>";
?>
<?php require_once 'footer.php'; ?>
</body>
</html>
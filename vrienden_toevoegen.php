<?php
require_once 'connection.php';
require_once 'header.php';
$db = Database::getInstance();
$conn = $db->getConnection();
$current_id = $_SESSION['id'] ?? 0;

// Vriendschapsverzoeken ophalen
$stmt = $conn->prepare("SELECT v.*, u.username FROM vrienden v JOIN users u ON v.gebruiker_id = u.id WHERE v.vrienden_id = :id AND v.accepted = 0");
$stmt->bindParam(':id', $current_id, PDO::PARAM_INT);
$stmt->execute();
$verzoeken = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Toon vriendschapsverzoeken
if (count($verzoeken) > 0) {
    echo "<h3>Vriendschapsverzoeken:</h3><ul class='vriendenlijst'>";
    foreach ($verzoeken as $verzoek) {
        echo "<li>";
        echo htmlspecialchars($verzoek['username']) . " wil vrienden worden.";
        echo "
            <form action='acceptatie_wijzigen.php' method='POST' style='display:inline;'>
                <input type='hidden' name='vrienden_id' value='" . htmlspecialchars($verzoek['username']) . "'>
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

// Alle andere gebruikers ophalen
$stmt = $conn->prepare("SELECT id, username FROM users WHERE id != :current_id");
$stmt->bindParam(':current_id', $current_id, PDO::PARAM_INT);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Toon alle gebruikers
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
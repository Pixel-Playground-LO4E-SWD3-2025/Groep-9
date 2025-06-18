<?php
require 'connection.php';
session_start();

$stmt = $conn->prepare("SELECT * FROM vrienden WHERE vrienden_id = :id AND accepted = 0");
$stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
$stmt->execute();

// hier onder mag een if statement komen die controleert of er geen records zijn gevonden,
// als die er wel zijn dan echo je deze met een accept or decline knop, als die er niet zijn dan echo je wat er al staat

if ($stmt ->rowCount() > 0) {
    ?>
    <ul>
<?php foreach ($users as $user): ?>
    <li>
        <?= htmlspecialchars($user['username']) ?>
        <form action="toevoegen.php" method="POST" style="display:inline;">
            <input type="hidden" name="vrienden_id" value="<?= $user['id'] ?>">
            <button type="submit">Vriend toevoegen</button>
        </form>
    </li>
<?php endforeach; ?>
    <li>
        <?= htmlspecialchars($user['username']) ?>
        <form action="toevoegen.php" method="POST" style="display:inline;">
            <input type="hidden" name="vrienden_id" value="<?= $user['id'] ?>">
            <button type="submit">Vriend afwijzen</button>
        </form>

            <form action="toevoegen.php" method="POST" style="display:inline;">
            <input type="hidden" name="vrienden_id" value="<?= $user['id'] ?>">
            <input type="hidden" name="afwijzen" value="afwijzen">
            <button type="submit">Vriend afwijzen</button>
        </form>
    </li>
<?php   
} else {

}

$current_id = $_SESSION['id'] ?? 0;

$stmt = $conn->prepare("SELECT id, username FROM users WHERE id != :current_id");
$stmt->bindParam(':current_id', $current_id, PDO::PARAM_INT);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>





?>

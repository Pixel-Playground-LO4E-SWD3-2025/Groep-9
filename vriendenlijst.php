<?php
require 'connection.php';
session_start();
var_dump($_SESSION);

$current_id = $_SESSION['id'] ?? 0;

$stmt = $conn->prepare("SELECT id, username FROM users WHERE id != :current_id");
$stmt->bindParam(':current_id', $current_id, PDO::PARAM_INT);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<ul>
<?php foreach ($users as $user): ?>
    <li>
        <?= htmlspecialchars($user['username']) ?>
        <form action="toevoegen.php" method="POST" style="display:inline;">
            <input type="hidden" name="vrienden_id" value="<?= $user['id'] ?>">
            <input type="hidden" name="username" value="<?= htmlspecialchars($user['username']) ?>">
            <button type="submit">Vriend toevoegen</button>
        </form>
    </li>
<?php endforeach;



?>

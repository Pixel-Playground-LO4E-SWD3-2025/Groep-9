<?php require_once 'header.php';
session_start();
require_once 'connection.php';
if (isset($_SESSION['error'])) {
    echo '<article class="error">' . $_SESSION['error'] . '</article>';
    unset($_SESSION['error']);
}
if (!isset($_SESSION['user_id'])) {
    header("Location: inloggen.php");
    exit();
}
$current_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
if (isset($_POST['vrienden_id'] )) {

    $vrienden_id = $_POST['vrienden_id'];
    
    if(isset($_POST['afwijzen']){
    
        try {
        $stmt = $conn->prepare("DELETE FROM vrienden WHERE gebruiker_id = :id AND vrienden_id = :vrienden_id");
        $stmt->bindParam(':id', $current_id);
        $stmt->bindParam(':vrienden_id', $vrienden_id);
        $stmt->execute();
        echo "<p>Vriendschap succesvol beëindigd!</p>";
    } catch (PDOException $e) {
        echo "<p>Fout bij het beëindigen van vriendschap: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
    } else {
        $stmt = $conn->prepare("UPDATE vrienden SET accepted = 0 WHERE gebruiker_id = :id AND vrienden_id = :vrienden_id");
        $stmt->bindParam(':id', $current_id);
        $stmt->bindParam(':vrienden_id', $vrienden_id);
        $stmt->execute();
    })
} else {
    echo "<p>Ongeldige gebruikersgegevens.</p>";
}

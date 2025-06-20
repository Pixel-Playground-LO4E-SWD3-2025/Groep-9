<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="hier kun je vrienden afwijzen. Selecteer een vriendschap verzoek en beëindig de vriendschap.">
    <meta name="keywords" content="vriend, reject, friendship, social, network, game">
    <meta name="author" content="raay">
    <title>Afwijzen</title>
</head>
<body>
    
</body>
</html>



<?php require_once 'header.php';
require_once 'connection.php';
session_start();
$db = Database::getInstance();
$conn = $db->getConnection();
if (isset($_SESSION['error'])) {
    echo '<article class="error">' . $_SESSION['error'] . '</article>';
    unset($_SESSION['error']);
}
if (!isset($_SESSION['user_id'])) {
    header("Location: inloggen.php");
    exit();
}

$current_id = $_SESSION['user_id'];
if (isset($_POST['username'] )) {

    $username = $_POST['username'];
    
    {
    
        try {
        $stmt = $conn->prepare("DELETE FROM vrienden WHERE username = :username");
        // $stmt->bindParam(':id', $current_id);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        echo "<p>Vriendschap succesvol beëindigd!</p>";
        header("Location: vrienden_toevoegen.php");
    } catch (PDOException $e) {
        echo "<p>Fout bij het beëindigen van vriendschap: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}
} else {
    echo "<p>Ongeldige gebruikersgegevens.</p>";
}

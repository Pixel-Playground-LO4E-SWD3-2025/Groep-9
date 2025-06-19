<?php require_once 'connection.php'; 
require_once 'header.php';

if (isset($_POST['vrienden_id']))
    echo "<p>Gebruiker gevonden!</p>";  
{
    
    $current_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    $vrienden_id = $_POST['vrienden_id'];


    if ($current_id && $vrienden_id) {
        try {
        $stmt = $conn->prepare("UPDATE `vrienden` SET accepted= 1 WHERE vrienden_id = :vrienden_id AND gebruiker_id = :id");
        $stmt->bindParam(':id', $current_id);
        $stmt->bindParam(':vrienden_id', $vrienden_id);
        $stmt->execute();

            echo "<p>Vriend succesvol toegevoegd!</p>";
        } catch (PDOException $e) {
            echo "<p>Fout bij het toevoegen van vriend: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    } else {
        echo "<p>Ongeldige gebruikersgegevens.</p>";
    }

}

?>

<a href="vriendenlijst.php">
    <button type="button">Terug naar vriendenlijst</button>
</a>
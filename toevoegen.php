<?php require_once 'connection.php'; 

session_start();

var_dump($_POST);    

if (isset($_POST['user_id']))
    echo "<p>Gebruiker gevonden!</p>";  
{
    
    
    $current_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    $vrienden_id = $_POST['vrienden_id'];

    if ($current_id && $vrienden_id) {
        try {
        $accepted = 1;
        $stmt = $conn->prepare("INSERT INTO vrienden (gebruiker_id, vrienden_id, username, accepted) VALUES (:id, :vrienden_id, :username, :accepted)");
        $stmt->bindParam(':id', $current_id);
        $stmt->bindParam(':vrienden_id', $vrienden_id);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':accepted', $accepted);
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
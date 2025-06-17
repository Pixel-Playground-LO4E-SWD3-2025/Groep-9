<?php 
session_start();
require_once 'connection.php';


if(!isset($_SESSION['user_id'])){
    header('location: inloggen.php');
    exit();
}
$user_id = $_SESSION['user_id'];

try{
$deleteUser = "DELETE FROM users WHERE id = ?";
$stmt = $conn->prepare($deleteUser);
$stmt->execute([$user_id]);

session_destroy();
header('location: index.php');
}catch (PDOException $e){
    
    $_SESSION['error'] = "Er is een fout opgetreden bij het verwijderen van je account. Probeer het Later opnieuw.";
    header('location: profiel.php');
    exit();

}
?>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Verwijderd</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <section>
            <article class="account-deleted">
                <h1>Account verwijderd</h1>
                <P>Je account is succesvol verwijderd.</p>
                <p>Bedankt voor het gebruik van PixelGame!</p>
                <a href="index.php">Terug naar Home</a>
                <a href="Register.php">Registeer een nieuw account</a>
            </article>
        </section>
   </main>
</body>
</html>
<?php
require_once 'footer.php';    
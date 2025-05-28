<?php 
if (session_status() == PHP_SESSION_NONE){
    session_start();
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Van Oma Kost is een gezellig restaurant dat de authentieke smaken van traditionele Nederlandse thuiskookkost op tafel brengt. Geïnspireerd door gekoesterde familierecepten die generaties lang zijn doorgegeven.">
    <meta name ="keywords" content="Huisgemaakte gerechten , Authentieke familierecepten , Oma's koken , Huisstijl maaltijd , Klassieke Nederlandse gerechten">
    <meta name="author" content="David">
    <title>PixelGame</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/game.js" defer></script>
</head>
<header>
    <nav> 
     <img src="img/panther.png" alt="Logo" class="logo">
     <a href="index.php">Home</a>
     <a href="Game-menu.php">Games</a>
     <a href="over_ons.php">Over ons</a>
     <a href="contact.php">Contacten</a>
<!-- Als user_id niet bestaat in session -->
    <?php if(!isset($_SESSION['user_id'])): ?>
        <a href="inloggen.php">👤</a> <!--  Laat dit zien -->
    <?php else: ?>
        <a href="profiel.php">👤 <?php echo $_SESSION['username']; ?></a> <!--  Laat dit zien -->
        <a href="logout.php">👤 Uitloggen</a> <!--  Laat dit zien -->
    <?php endif; ?>
    </nav>
</header>
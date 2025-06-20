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
    <meta name="description" content="PixelGame is een platform voor het spelen van diverse online games.">
    <meta name ="keywords" content="PixelGame, spelletjes, online games, gratis spellen, browser games, Dino game, Rock Paper Scissors, highscore">
    <meta name="author" content="David">
    <title>PixelGame</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/highscores.css">
    <script src="js/game.js" defer></script>
    <script src="js/Navbar.js" defer></script>
</head>
<header>
    <nav> 
     <img src="img/panther.png" alt="Logo" class="logo">
     <button class="menu">&#9776;</button>
     <a href="index.php">Home</a>
     <a href="Game-menu.php">Games</a>
     <a href="highscores.php">Highscores</a>
     <a href="over_ons.php">Over ons</a>
     <a href="contact.php">Contacten</a>
     <a href="vriendenlijst.php">Vriendenlijst</a>
<!-- Als user_id niet bestaat in session -->
    <?php if(!isset($_SESSION['user_id'])): ?>
        <a href="inloggen.php">👤</a> <!--  Laat dit zien -->
    <?php else: ?>
        <a href="profiel.php">👤 <?php echo $_SESSION['username']; ?></a> <!--  Laat dit zien -->
        <a href="logout.php">👤 Uitloggen</a> <!--  Laat dit zien -->
    <?php endif; ?>
    </nav>
</header>
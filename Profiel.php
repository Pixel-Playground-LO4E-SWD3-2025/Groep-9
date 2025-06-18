<?php require_once 'header.php'; ?>
<?php
include_once 'connection.php';
$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$photoPath = $user['profile_photo'] ?? null; //kijk even of de database een profiel foto heeft anders zet het op null//
$photoPath = $_SERVER['DOCUMENT_ROOT']. '/' .$photoPath; //maak een absolute pad van de foto zodat het altijd werkt.//

?>

<body>
    <main>
        <section>
            <video class="skycolor" autoplay loop muted src="video/skycolor.mp4"></video>
            <article class="profielpagina">
                <h1 Profiel pagina van <?php echo $_SESSION['username']; ?>></h1> <br>

                <?php if(!empty($user['profile_photo']) && file_exists($user['profile_photo'])): ?>
                 <img class="profielPage" src="<?php echo htmlspecialchars($user['profile_photo']); ?>" alt="profiel-foto">
                <?php else: ?>
                 <img class="profielPage" src="img/profile.png" alt="profiel-foto">
                <?php endif; ?>


                <p>Welkom op je profielpagina, <?php echo $_SESSION['username']; ?>!</p> <br>
                <p>Hier kun je Persoonlijke informatie zien en beheren.</p><br>
                <p>Je gebruikersnaam is: <?php echo $_SESSION['username']; ?></p> <br>  
                <p>Je gebruikers ID is: <?php echo $_SESSION['user_id']; ?></p> <br>
                <p>Je bent ingelogd op: <?php echo date('y-m-d H:i:s'); ?></p> <br>
                <p>Je kunt je profiel bewerken of uitloggen via de onderstaande knoppen.</p> <br>
                <a id="editprofiel" href="edit_Profiel.php">Profiel bewerken</a> <br>
                <a id="uitlogbutton2" href="logout.php">Uitloggen</a> <br>
           </article>
       </section>           
   </main>
</body>  
<?php require_once 'footer.php'; ?>
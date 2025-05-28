<?php require_once 'header.php'; ?>
<body>
    <main>
        <section>
            <video class="skycolor" autoplay loop muted src="video/skycolor.mp4"></video>
            <article class="profielpagina">
                <img class="ProfielPage" src="img/profile.png" alt="profiel-foto">
                <h1 Profiel pagina van <?php echo $_SESSION['username']; ?>></h1> <br>
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
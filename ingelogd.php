<?php 
require_once 'header.php';

if(!isset($_SESSION['user_id'])){
    header("Location: inloggen.php");
    exit();
}   

?>
<body>
    <main>
        <section>
            <video class="skycolor" autoplay loop muted src = "video/Skycolor.mp4"></video>
            <article>
                <h1>Welcome <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
                <p>Je bent succesvol ingelogd.</p>
                <a id="uitlogbutton" href="logout.php" onclick= "return confirm('Weet je zeker dat je wilt uitloggen?')">Uitloggen</a>
           </article> 
       </section>   
   </main>
</body>
<?php require_once 'footer.php'; ?> 
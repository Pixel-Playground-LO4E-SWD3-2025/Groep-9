<?php 

session_start();
require_once 'connection.php';
$db = Database::getInstance();
$conn = $db->getConnection();


if (isset($_SESSION['error'])){
   echo '<article class="error">' . $_SESSION['error'] . '</article>';
   unset($_SESSION['error']);
}
?>
<?php require_once 'header.php'; ?>
<body>
    <main>
        <section>
              <video class="skycolor" autoplay loop muted src = "video/Skycolor.mp4"></video>
              <article>
                <h1 id="loginwoord">Inloggen</h1>

                <form action="login_process.php" method="POST">
                     <label for ="Username">Username:</label>
                     <input type="text" id="username" name="username" required>
                     <label for ="email">Email: </label>
                     <input type="Email" id="email" name="email" required>
                     <label for="password">password:</label>
                     <input type="password" id="password" name="password" required>
                     <button id="inlogbutton"type ="submit" name="login">Login</button>
                </form>
                  <form action="Registreer-html.php" method="POST">
                  <button id="Account-aanmaken"  href="Registreer-html.php"> Maak een account aan</a>
                  </form>
            </article>
        </section> 
    </main>
</body>        
<?php require_once 'footer.php'; ?>





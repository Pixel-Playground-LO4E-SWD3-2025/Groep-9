<?php require_once 'header.php'; ?>
<body>
    <main>
        <section>
              <video class="skycolor" autoplay loop muted src = "video/Skycolor.mp4"></video>
              <article>
                <h1 id="loginwoord">Inloggen</h1>
                <form action= inloggen.php>
                  <label for ="Username">Username:</label>
                    <input type="text" id="username" name="username" required>
                      <label for ="email">Email: </label>
                        <input type="Email" id="email" name="email" required>
                    <label for="password">password:</label>
                     <input type="password" id="password" name="password" required>
              </form>
            </article>
        </section>
    </main>
</body>        
<?php require_once 'footer.php'; ?>


<?php require_once 'connection.php'; ?>

